const btnDeleteAll = document.querySelector("#allDelete");
const check = document.querySelectorAll(".check");
const checkAll = document.querySelector("#checkAll");
let tableau = [];

function selectionerTous() {
  console.log(this.checked);
  for (element of check) {
    element.checked = this.checked;
  }
}
checkAll.addEventListener("click", selectionerTous);

function recupId() {
  //event.preventDefault();

  check.forEach((element) => {
    if (element.checked) {
      tableau.push(element.value);
    }
  });
  if (tableau.length != 0) {
    if (confirm("confirmer vous la suppression")) {
      let chaine = tableau.join();
      let target = this.href + "?checkDelete_id=" + chaine;
      this.href = target;
    } else {
      console.log("no confirmé");
    }
  } else {
    confirm("veillez coché une case");
  }
}
btnDeleteAll.addEventListener("click", recupId);
