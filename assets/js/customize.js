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
    var top_breadcrumb = $("#top_breadcrumb");
    var loader = local.loader;

    /**
     *
     * Common Ajax function
     *
     */
    function ajax_init(formData = [], getthis = null, topgap = null) {
      if (top_breadcrumb.length) {
        if (topgap != null) {
          top_breadcrumb.css("padding-top", topgap);
        }
        top_breadcrumb[0].scrollIntoView({
          behavior: "smooth",
          block: "start",
        });
      }
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
            if (response.data.cost_type == "quotation") {
              location.href = local.quotationurl;
            }
            if (response.data.cost_type == "account") {
              location.reload();
            }
            if (response.data.delete == "istrue") {
              getthis.closest("tr").remove();
            }
          } else {
            error_text.html(response.data.message);
          }
          loader_render.empty();
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
     * quotation_submission_form
     *
     */
    $(document).on("submit", ".quotation_submission_form", function (e) {
      e.preventDefault();
      var t = $(this);
      var formData = new FormData(this);
      formData.append("action", "quotation_submission_form_handler");
      ajax_init(formData, "", "100px");
    });

    /**
     *
     * account_submission_form
     *
     */
    $(document).on("submit", ".account_submission_form", function (e) {
      e.preventDefault();
      var t = $(this);
      var formData = new FormData(this);
      formData.append("action", "account_submission_form_handler");
      ajax_init(formData, "");
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
      ajax_init(formData, t, null);
    });

    /**
     *
     * pdf init
     *
     */
    $(document).on("click", ".inventory_pdf_export", function () {
      var t = $(this);
      var pdfname = t.data("pdfname");
      var layout = t.data("layout");
      var layoutsize = "auto";
      var gap = "1cm";
      if (layout != null) {
        layoutsize = layout;
        gap = "0cm";
      }
      kendo.drawing
        .drawDOM($(".inventory_pdf_body"))
        .then(function (group) {
          return kendo.drawing.exportPDF(group, {
            paperSize: layoutsize,
            margin: { left: gap, top: gap, right: gap, bottom: gap },
          });
        })
        .done(function (data) {
          kendo.saveAs({
            dataURI: data,
            fileName: pdfname,
          });
        });
    });

    /**
     *
     * dropdown open close
     *
     */
    $(document).on("click", ".dropdown_tab_click", function (e) {
      e.stopPropagation();
      var t = $(this);
      var dropdown_wrap_box = t.parent().find(".dropdown_wrap_box");
      var svg = t.find("svg");

      dropdown_wrap_box.toggleClass("hidden");
      svg.css(
        "rotate",
        dropdown_wrap_box.hasClass("hidden") ? "0deg" : "180deg"
      );
    });
    $(document).on("click", function () {
      $(".dropdown_wrap_box").addClass("hidden");
      $(".dropdown_tab_click svg").css("rotate", "0deg");
    });
    $(document).on("dblclick", ".dropdown_tab_click", function () {
      $(this).find("svg").css("rotate", "0deg");
    });

    /**
     *
     * Repeater init
     *
     */
    $(".inventory_repeater").repeater({
      isFirstItemUndeletable: true,
      show: function () {
        $(this).slideDown();
      },
      hide: function (deleteElement) {
        $(this).slideUp(deleteElement);
      },
      ready: function (setIndexes) {},
    });
  });
})(jQuery);
