class Bottle {
  name;
  image;
  price;
  size;
  identity_id;
  vintage;
  country_id;

  constructor(
    name,
    image,
    price,
    size,
    identity_id,
    vintage,
    country_id,
    cellar_id,
  ) {
    this.name = name;
    this.image = image;
    this.price = price;
    this.size = size;
    this.identity_id = identity_id;
    this.vintage = vintage;
    this.country_id = country_id;
    this.cellar_id = cellar_id;
  }

  representationHTMLCardBottle() {
    const titreHTML = document.createElement("h3");
    titreHTML.textContent = this.name;
    titreHTML.classList.add("titlered");

    const imgHTML = document.createElement("img");
    imgHTML.src = `${this.image}`;
    // imgHTML.classList.add("");

    const priceHTML = document.createElement("h4");
    priceHTML.textContent = this.price;

    const sizeHTML = document.createElement("h4");
    sizeHTML.textContent = this.size;

    const identityHTML = document.createElement("h4");
    identityHTML.textContent = this.identity_id;

    const vintageHTML = document.createElement("h4");
    vintageHTML.textContent = this.vintage;

    const countryHTML = document.createElement("h4");
    countryHTML.textContent = this.country_id;

    const divFlex = document.createElement("div");
    divFlex.classList.add("flex-row");

    const divHTML = document.createElement("div");
    divHTML.append(titreHTML);
    // divHTML.classList.add("");

    const ChangerQuantityBoutonHTML = document.createElement("a");
    // ChangerQuantityBoutonHTML.classList.add("");
    ChangerQuantityBoutonHTML.href = `http://127.0.0.1:8000/cellars/${this.cellar_id}/show`;
    ChangerQuantityBoutonHTML.textContent = "Changer la quantité";
    divFlex.append(ChangerQuantityBoutonHTML);

    const RemoveBottleBoutonHTML = document.createElement("a");
    // RemoveBottleBoutonHTML.classList.add("");
    RemoveBottleBoutonHTML.href = `http://127.0.0.1:8000/cellars/${this.cellar_id}/show`;
    RemoveBottleBoutonHTML.textContent = "Retirer la bouteille";
    divFlex.append(RemoveBottleBoutonHTML);

    const article = document.createElement("article");
    // article.classList.add("");
    article.append(divHTML);
    article.append(imgHTML);
    article.append(priceHTML);
    article.append(sizeHTML);
    article.append(identityHTML);
    article.append(vintageHTML);
    article.append(countryHTML);
    article.append(divFlex);

    return article;
  }
}

let bottles = [];

window.addEventListener("DOMContentLoaded", async () => {
  const pathParts = window.location.pathname.split("/");
  const cellar_id = pathParts[2];

  const res = await fetch(`http://127.0.0.1:8000/cellar-data/`, {
    method: "GET",
    headers: {
      Accept: "application/json",
    },
  });

  const objetRes = await res.json();
  console.log(objetRes);

  const bottleArray = objetRes.cellar_has_bottles;

  for (let i = 0; i < bottleArray.length; i++) {
    const bottleData = bottleArray[i];

    const bottle = new Bottle(
      bottleData.name,
      bottleData.image,
      bottleData.price,
      bottleData.size,
      bottleData.identity_id,
      bottleData.vintage,
      bottleData.country_id,
      cellar_id,
    );

    bottles.push(bottle);
  }

  createMain(bottles);
});

function createMain(bottles) {
  const section = document.querySelector("#mainCellarBootles");
  section.innerHTML = "";
  const div = document.createElement("div");
  // div.classList.add("", "");

  bottles.forEach((bottle) => {
    div.append(bottle.representationHTMLCardBottle());
  });

  section.append(div);
}
