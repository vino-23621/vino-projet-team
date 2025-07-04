
const fs = require('fs');
const endpoint = 'https://catalog-service.adobe.io/graphql';

const query = `
query productSearch(
  $phrase: String!
  $pageSize: Int
  $currentPage: Int = 1
  $filter: [SearchClauseInput!]
  $sort: [ProductSearchSortInput!]
  $context: QueryContextInput
) {
  productSearch(
    phrase: $phrase
    page_size: $pageSize
    current_page: $currentPage
    filter: $filter
    sort: $sort
    context: $context
  ) {
    total_count
    items {
      product {
        name
        sku
        canonical_url
        image { url }
        description { html }
        price_range {
          minimum_price {
            final_price { value currency }
            regular_price { value currency }
            fixed_product_taxes { amount { value currency } label }
            discount { percent_off amount_off }
          }
          maximum_price {
            final_price { value currency }
            regular_price { value currency }
            fixed_product_taxes { amount { value currency } label }
            discount { percent_off amount_off }
          }
        }
      }
      productView {
        attributes {
          label
          name
          value
        }
      }
    }
    page_info {
      current_page
      page_size
      total_pages
    }
  }
}
`;

const variables = {
  phrase: "",
  pageSize: 24,
  currentPage: 1,
  filter: [
    { attribute: "categoryPath", eq: "produits/vin" },
    { attribute: "availability_front", in: ["En ligne", "En succursale", "Disponible bientôt", "Bientôt en loterie", "En loterie"] },
    { attribute: "visibility", in: ["Catalog", "Catalog, Search"] }
  ],
  // sort: [
  //   { attribute: "taux_sucre_filter", direction: "ASC" }
  // ],
  context: {
    customerGroup: "b6589fc6ab0dc82cf12099d1c2d40ab994e8410c",
    userViewHistory: []
  }
};

async function fetchProducts() {
  try {
    const response = await fetch(endpoint, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Api-Key': '7a7d7422bd784f2481a047e03a73feaf',
        'Magento-Environment-Id': '2ce24571-9db9-4786-84a9-5f129257ccbb',
        'Magento-Website-Code': 'base',
        'Magento-Store-Code': 'main_website_store',
        'Magento-Store-View-Code': 'fr',
        'Magento-Customer-Group': 'b6589fc6ab0dc82cf12099d1c2d40ab994e8410c',
      },
      body: JSON.stringify({ query, variables }),
    });

    const json = await response.json();

    // Print entire response for debugging
    // console.log('Full response:', JSON.stringify(json, null, 2));


    // fs.writeFileSync('products.json', JSON.stringify(json, null, 2), 'utf-8');
    // console.log('Raw JSON saved to products.json');


    if (!json.data || !json.data.productSearch) {
      console.error('No productSearch data found. Check query and API response.');
      return;
    }

    const products = json.data.productSearch.items.map((item) => {
      const product = item.product;
      const attributes = item.productView?.attributes || [];

      const getAttribute = (name) =>
        attributes.find((attr) => attr.name === name)?.value || null;

      return {
        name: product.name,
        // sku: product.sku,
        // url: product.canonical_url,
        image: product.image?.url,
        // description: product.description,
        price: product.price_range?.minimum_price?.final_price.value,
        // color: getAttribute('couleur'),
        // grape_variety: getAttribute('cepage'),
        // flavor: getAttribute('aromate'),
        // designation: getAttribute('appellation'),
        size: getAttribute('format_contenant_ml'),
        identity: getAttribute('identite_produit'),
        vintage: getAttribute('millesime_produit'),
        country: getAttribute('pays_origine'),
      };
    });

    fs.writeFileSync('processed_products.json', JSON.stringify(products, null, 2), 'utf-8');
    console.log('Processed JSON saved to processed_products.json');

    console.log(JSON.stringify(products, null, 2));
  } catch (error) {
    console.error('Error fetching products:', error);
  }
}

fetchProducts();
