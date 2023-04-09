$(function () {
  $("#checkAll").click(function () {
    console.log(this.checked);

    for (element of $(".check")) {
      element.checked = this.checked;
    }
  });
  $("#allDelete").click(function () {
    if ($("#checkAll")[0].checked) {
      var str = $(".check").serialize();
      console.log(str);
      $.ajax({
        type: "POST",
        url: "test.php",
        data: str,
        success: function (response) {
          $("#divAffichageResultat").html(response); //Affichage de l'url cible, ici AjaxTemplate02.php, dans une DIV
          $("#status").text("Posté");
          //console.log(response);
        },
        error: function (response) {
          $("#status").text(
            "Erreur pour poster le formulaire : " +
              response.status +
              " " +
              response.statusText
          );
          //console.log(response);
        },
      });
    } else {
      var form = $(".check");

      var str = form.serialize();
      console.log(str);
      $.ajax({
        type: "POST",
        url: "delete_All_Check.php",
        data: str,
        success: function (response) {
          $("#divAffichageResultat").html(response); //Affichage de l'url cible, ici AjaxTemplate02.php, dans une DIV
          $("#status").text("Posté");
          //console.log(response);
        },
        error: function (response) {
          $("#status").text(
            "Erreur pour poster le formulaire : " +
              response.status +
              " " +
              response.statusText
          );
          //console.log(response);
        },
      });
    }
    window.location.href = "test.php";
  });
});
