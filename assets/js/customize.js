(function ($) {
  "use strict";

  jQuery(document).ready(function ($) {
    /**
     *
     * Common Variable
     *
     */
    var loader_render = $(".loader_render");
    var show_spinner = $(".show_spinner");
    var error_text = $("#error_text");
    var loader = local.loader;

    /**
     *
     * Common Ajax function
     *
     */
    function ajax_init(formData = [], getthis = null) {
      loader_render.html(loader);
      error_text.empty();
      $.ajax({
        type: "POST",
        url: local.ajaxurl,
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
          if (response.success) {
            if (response.data.cost_type == "rmb") {
              location.href = local.rmburl;
            }
            if (response.data.cost_type == "inr") {
              location.href = local.inrurl;
            }
            if (response.data.cost_type == "taka") {
              location.href = local.takaurl;
            }
            if (response.data.cost_type == "sell") {
              location.href = local.sellurl;
            }
            if (response.data.cost_type == "sell") {
              location.href = local.sellurl;
            }
            if (response.data.cost_type == "login") {
              location.href = local.homeurl;
            }
            if (response.data.delete == "istrue") {
              getthis.closest("tr").remove();
            }
          } else {
            error_text.html(response.data.message);
          }
          loader_render.empty();
          console.log(response);
        },
        error: function (error) {
          console.log(error);
        },
      });
    }

    /**
     *
     * RMB/INR/Taka Form submission
     *
     */
    $(document).on("submit", ".rmb_submission_form", function (e) {
      e.preventDefault();
      var t = $(this);
      var formData = new FormData(this);
      formData.append("action", "submission_form_handler");
      ajax_init(formData);
    });

    /**
     *
     * RMB/INR/Taka sell_submission_form
     *
     */
    $(document).on("submit", ".sell_submission_form", function (e) {
      e.preventDefault();
      var t = $(this);
      var dataquantity = t.find("select option:selected").data("quantity");
      var inputquantity = t.find("input[name='quantity']").val();

      if (inputquantity > dataquantity) {
        alert(
          `This product's available quantity is ${dataquantity}. Please select a quantity equal to or less than ${dataquantity}.`
        );
      } else {
        // Proceed with form submission
        var formData = new FormData(this);
        formData.append("action", "sell_submission_form_handler");
        ajax_init(formData);
      }
    });

    /**
     *
     * Login Form submit
     *
     */
    $(document).on("submit", ".login_form_submission", function (e) {
      e.preventDefault();
      var t = $(this);
      var formData = new FormData(this);
      formData.append("action", "login_submission_form_handler");
      ajax_init(formData);
    });

    /**
     *
     * delete_table_record
     *
     */
    $(document).on("click", ".delete_table_record", function (e) {
      e.preventDefault();
      var t = $(this);
      var productid = t.data("productid");
      var media = t.data("media");
      var formData = new FormData();
      formData.append("action", "delete_table_record_handler");
      formData.append("productid", productid);
      formData.append("media", media);
      t.closest(show_spinner).find("button").css("visibility", "hidden");
      t.closest(show_spinner).append(local.spinner);
      ajax_init(formData, t);
    });

    /**
     *
     * pdf init
     *
     */
    $(document).on("click", ".inventory_pdf_export", function () {
      var t = $(this);
      var pdfname = t.data("pdfname");
      kendo.drawing
        .drawDOM($(".inventory_pdf_body"))
        .then(function (group) {
          return kendo.drawing.exportPDF(group, {
            paperSize: "auto",
            margin: { left: "1cm", top: "1cm", right: "1cm", bottom: "1cm" },
          });
        })
        .done(function (data) {
          kendo.saveAs({
            dataURI: data,
            fileName: pdfname,
          });
        });
    });
  });
})(jQuery);
