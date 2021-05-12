tabRegex = {
  nom: /^[\p{L}\s]{2,15}$/u,
  prenom: /^[\p{L}\s]{2,15}$/u,
  email: /^[a-zA-Z]+[\w]+[@][a-z\.\-]{1,20}[\.][a-z]{1,3}$/,
  tel: /^[+]?[0-9]{8,}$/,
  typeSoc: /^[\w]{1,10}$/,
  typeSoc1: /^[\w]{1,10}$/,
  adresse: /./,
  description: /./,
  lien: /^http/,
};

function validationClient(idform) {
  $("#" + idform).submit(function (event) {
    let form = $(event.target);

    let nomForm = [];
    $("#" + idform + " input").each(function () {
      if ($(this).attr("type") != "file") {
        nomForm.push($(this).attr("name"));
      }
    });
    console.log(nomForm);

    let valeurForm = [];

    for (i = 0; i < nomForm.length; i++) {
      valeurForm.push($("#" + nomForm[i]).val());
    }

    let validation = parcourNomform(nomForm, valeurForm);
    console.log(v);
    if (validation != nomForm.length) {
      event.preventDefault();

      //traitementen cas d'erreur
    }
  });
}

function parcourNomform(form, valeur) {
  let f = 0;

  for (i = 0; i < t.length; i++) {
    $("[name=" + form[i] + "]").removeClass("bg-danger text-white");
    tabRegex[form[i]].test(valeur[i])
      ? (f += 1)
      : $("[name=" + form[i] + "]").addClass("bg-danger text-white");
  }

  return f;
}
