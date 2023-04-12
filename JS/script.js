import Swal from "sweetalert2";
$(function () {
  let del = $("a.delete");

  $(del).each(function () {
    $(this).on("click", function (e) {
      e.preventDefault();

      let link = $(this);
      let target = $(this).attr("href");

      Swal.fire({
        title: "Confirmez vous la suppression?",
        text: "Cette action est irréversible",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#ca3c66",
        cancelButtonColor: "#4aa3a2",
        confirmButtonText: "Oui. Supprime!",
        cancelButtonText: "Nooon!",
      })
        .then((result) => {
          if (result.isConfirmed) {
            Swal.fire("Deleted!", "Suppression avec succès", "success");
          }
          if (result.value) {
            fetch(target, { method: "get" })
              .then((response) => response.json())
              .then((message) => {
                console.log(message);
                Swal.fire({
                  title: "Yeah !",
                  html: "<p>" + message.success + "</p>",
                  type: "success",
                });
              });
            setTimeout(() => {
              document.location.reload(true);
            }, 1500);
          }
        })

        .catch((err) => {
          console.log(err);
          Swal.fire({
            title: "Oups!",
            text: "Un erreur est survenue. la ligne n'a pas été supprimé",
            type: "error",
          });
        });
    });
  });

  //Checkbox DELETE
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
        url: "list.php",
        data: str,
        success: function (response) {
          // $("#divAffichageResultat").html(response); //Affichage de l'url cible, ici AjaxTemplate02.php, dans une DIV
          // $("#status").text("Posté");
          Swal.fire({
            title: "Confirmez vous la suppression?",
            text: "Cette action est irréversible",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#4aa3a2",
            cancelButtonColor: "#ca3c66",
            confirmButtonText: "Oui. Supprime!",
            cancelButtonText: "Nooon!",
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            }
            if (result.value) {
              setTimeout(() => {
                document.location.reload(true);
              }, 1500);
            }
          });
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
        url: "list.php",
        data: str,
        success: function (response) {
          //$("#divAffichageResultat").html(response); //Affichage de l'url cible, ici AjaxTemplate02.php, dans une DIV
          //$("#status").text("Posté");
          Swal.fire({
            title: "Confirmez vous la suppression?",
            text: "Cette action est irréversible",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#4aa3a2",
            cancelButtonColor: "#ca3c66",
            confirmButtonText: "Oui. Supprime!",
            cancelButtonText: "Nooon!",
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire("Deleted!", "Your file has been deleted.", "success");
            }
            if (result.value) {
              setTimeout(() => {
                document.location.reload(true);
              }, 1500);
            }
          });

          //console.log(response);
        },
        error: function (response) {
          // $("#status").text(
          //   "Erreur pour poster le formulaire : " +
          //     response.status +
          //     " " +
          //     response.statusText
          // );
          Swal.fire({
            title: "Oups!",
            text: "Un erreur est survenue. la ligne n'a pas été supprimé",
            type: "error",
          });
          //console.log(response);
        },
      });
    }
  });
});
