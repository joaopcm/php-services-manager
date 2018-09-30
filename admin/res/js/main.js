$(function (c) {

	// Inicializa o DataTables
	$('.table').DataTable({
		paging: false,
		searching: false,
		info: false
	});

	// Recupera dados de localização de acordo com o CEP
	var options = {
		onComplete: function(cep) {
			$.ajax({
				type: "POST",
				url: "/localizacao/" + $("#cep").cleanVal(),
				success: function (f) {
					f = $.parseJSON(f);
					$("#endereco").val(f.logradouro);
					$("#bairro").val(f.bairro);
					$("#cidade").val(f.localidade);
					$("#estado").val(f.uf);
				}
			})
		}
	}
	$('#cep').mask('00000-000', options);

	// Faz a consulta de recebimentos na data passada
	var options = {
		onComplete: function(data) {
			location.href = "/administrar/recebimentos/" + data;
		}
	}
	$('#search-recebimentos').mask('00/0000', options);

	// Inicializa o Tooltip
	c('[data-toggle="tooltip"]').tooltip();

	// Inicializa o Chosen
	c(".chosen-select").chosen();

	// Campos de pesquisa
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

});