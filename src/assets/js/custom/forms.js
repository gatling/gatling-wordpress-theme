function customGetCookie(sKey) {
  if (!sKey) {
    return null;
  }
  return (
    decodeURIComponent(
      document.cookie.replace(
        new RegExp(
          "(?:(?:^|.*;)\\s*" +
            encodeURIComponent(sKey).replace(/[\-\.\+\*]/g, "\\$&") +
            "\\s*\\=\\s*([^;]*).*$)|^.*$"
        ),
        "$1"
      )
    ) || null
  );
}

function pleziForm(contentWebFormId, formId) {
  var form = document.getElementById("foss-" + contentWebFormId);
  if (form != undefined && form !== null) {
    $(form).validate();
    form.onsubmit = function (event) {
      event.preventDefault();
      if (!$(form).valid()) {
        return;
      }

      var xhttp = new XMLHttpRequest();
      xhttp.addEventListener("load", function () {
        if (this.readyState == 4 && this.status == 200) {
          var json = JSON.parse(this.responseText);
          if (
            json.email_contact_sent === true &&
            json.redirect_after_submit === true
          ) {
            window.location.replace(json.redirection_url);
          }
        }
      });

      var data = new FormData(form);
      data.append("content_web_form_id", contentWebFormId);
      data.append("form_id", formId);
      data.append("visit", customGetCookie("visit"));
      data.append("visitor", customGetCookie("visitor").split("---")[0]);

      var query = new URLSearchParams(data).toString();
      xhttp.open(
        "GET",
        "https://gatling.io/wp-admin/admin-ajax.php?action=gtl_forms&" + query,
        true
      );
      xhttp.setRequestHeader("Accept", "application/json");
      xhttp.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );
      xhttp.send();
    };
  }
}

// pleziForm("5d52c938e317a71d565409aa", "5d5188d4f420874ad39371d6");
