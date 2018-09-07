$(function (c) {

	$(".desrg").mask("99.999.999-*");
	c("#form-desidresponsible-2").hide();
	c("#form-desidresponsible-3").hide();
	c('[data-toggle="tooltip"]').tooltip();
	c(".chosen-select").chosen();
	c(".fix").on("keyup", function () {
		if (c(this).val().length > 0) {
			c(".counter").removeClass("invisible");
			c(".results").removeClass("invisible")
		} else {
			c(".counter").addClass("invisible");
			c(".results").addClass("invisible")
		}
	});
	c("#search").on("keyup", function () {
		var f = c("#search").val();
		var i = c(".results tbody").children("tr");
		var h = f.replace(/ /g, "'):containsi('");
		c.extend(c.expr[":"], {
			containsi: function (l, k, j, m) {
				return (l.textContent || l.innerText || "").toLowerCase().indexOf((j[3] || "").toLowerCase()) >= 0
			}
		});
		c(".results tbody tr").not(":containsi('" + h + "')").each(function (j) {
			c(this).attr("visible", "false")
		});
		c(".results tbody tr:containsi('" + h + "')").each(function (j) {
			c(this).attr("visible", "true")
		});
		var g = c('.results tbody tr[visible="true"]').length;
		c(".counter").text(g + " registros");
		if (g == "0") {
			c(".no-result").show()
		} else {
			c(".no-result").hide()
		}
	});
	c(".filterable .btn-filter").click(function () {
		c(".filters").toggleClass("invisible");
		var h = c(this).parents(".filterable"),
			g = h.find(".filters input"),
			f = h.find(".table tbody");
		if (g.prop("disabled") == true) {
			g.prop("disabled", false);
			g.first().focus()
		} else {
			g.val("").prop("disabled", true);
			f.find(".no-result").remove();
			f.find("tr").show()
		}
	});
	c(".responsible-values").on("click", function () {
		$id = c(this).attr("id-responsible");
		c.ajax({
			type: "POST",
			url: "/modal/responsavel/" + $id,
			success: function (f) {
				f = c.parseJSON(f);
				c("#modal-desname").empty();
				c("#modal-desname").append(f.desname);
				c("#modal-desrg").empty();
				c("#modal-desrg").append(f.desrg);
				c("#modal-descpf").empty();
				c("#modal-descpf").append(f.descpf);
				c("#modal-deslastaccess").empty();
				c("#modal-deslastaccess").append(f.deslastaccess + " às " + f.deslasttime);
				c("#modal-idresponsible").empty();
				c("#modal-idresponsible").append("<a href='/editar/responsavel/" + f.idresponsible + "'><i class='fa fa-pencil mx-1'></i></a>");
				c("#access-registry").attr("id-responsible", f.idresponsible)
			}
		})
	});
	c("#access-registry").on("click", function () {
		$id = c(this).attr("id-responsible");
		c.ajax({
			type: "POST",
			url: "/atualizar/acesso/" + $id,
			success: function (f) {
				location.reload()
			}
		})
	});
	var b = c(".add_field_button-1");
	var a = c(".add_field_button-2");
	var e = c(".remove_field_button-2");
	var d = c(".remove_field_button-3");
	c(b).on("click", function () {
		c("#form-desidresponsible-2").show();
		b.hide()
	});
	c(a).on("click", function () {
		c("#form-desidresponsible-3").show();
		b.hide();
		a.hide();
		e.hide()
	});
	c(e).on("click", function () {
		c("#form-desidresponsible-2 select").val("0");
		c("#form-desidresponsible-2").hide();
		b.show()
	});
	c(d).on("click", function () {
		c("#form-desidresponsible-3 select").val("0");
		c("#form-desidresponsible-3").hide();
		a.show();
		e.show()
	})
});

$("#iframe").on("load", function () {
	$(".modal").modal('hide');
	option = $("#iframe").contents().find("option");
	$("#desidresponsible-1, #desidresponsible-2, #desidresponsible-3").append(option[0]);
	$("#desidresponsible-1, #desidresponsible-2, #desidresponsible-3").trigger("chosen:updated");
});