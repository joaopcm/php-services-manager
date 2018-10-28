function copyToClipboard(a) {
	var b = $("<input>");
	$("body").append(b);
	b.val($(a).text()).select();
	document.execCommand("copy");
	b.remove()
};
$(function (c) {
	var error = 1;
	$(".btn-copy-p").on("click", function () {
		$(this).removeClass("btn-primary");
		$(this).addClass("btn-success");
		setTimeout(function () {
			$(".btn-copy-p").removeClass("btn-success");
			$(".btn-copy-p").addClass("btn-primary")
		}, 1500)
	});
	$("#row-table-protocols").hide();
	$(".open-img-modal").on("click", function () {
		anexo = $(this).attr("data-image");
		$("#download-img").attr("download-link", "\\baixar/anexo/" + anexo);
		$("#redirect-btn").attr("data-image", anexo);
		$("img#img-md").attr("src", "\\uploads/" + anexo);
		$("a#img-link").attr("href", "\\uploads/" + anexo);
		$("#img-modal").modal();
	});
	$("#redirect-btn").on("click", function () {
		anexo = $("#redirect-btn").attr("data-image");
		window.location.href = "\\uploads/" + anexo
	});
	$("#download-img").on("click", function () {
		window.location.href = $(this).attr("download-link")
	});
	$("input#opload-os").change(function () {
		i = $(this).prev("label").clone();
		file = $("#opload-os")[0].files[0].name;
		$("#label-upload-os").removeClass("btn-warning");
		$("#label-upload-os").addClass("btn-success")
	});
	var options = {
		onComplete: function (a) {
			$.ajax({
				type: "POST",
				url: "/admin/localizacao/" + $("#cep").cleanVal(),
				success: function (b) {
					b = $.parseJSON(b);
					$("#endereco").val(b.logradouro);
					$("#bairro").val(b.bairro);
					$("#cidade").val(b.localidade);
					$("#estado").val(b.uf)
				},
				error: function () {
					console.log("Erro - Não foi possível recuperar a lçocalização do CEP: " + $("#cep").cleanVal() + ".")
				}
			})
		}
	};
	$("#cep").mask("00000-000", options);
	$("#pesquisar-protocolo").on("keyup", function () {
		if ($(this).val().length === 20) {
			onCompleteS()
		} else {
			$("#row-table-protocols").hide();
			$(".list-a").remove();
			$("div.noresults-card div.alert").remove();
			error = 1;
		}
	});
	var options = {
		onComplete: function (a) {
			location.href = "/admin/recebimentos/" + a
		}
	};
	$("#search-recebimentos").mask("00/0000", options);
	c('[data-toggle="tooltip"]').tooltip();

	function onCompleteS() {
		var code = $("#pesquisar-protocolo").val();
		$.ajax({
			type: "POST",
			url: "/consultar/protocolo/" + code,
			success: function (data) {
				data = $.parseJSON(data);
				if (data.length === 0) {
					console.log("Aviso - O protocolo " + code + " não existe.");
					if (error === 1) {
						info = '<div class="alert alert-danger" role="alert"><strong>Ah não!</strong> Este protocolo não existe ou não foi atualizado.</div>';
						$("div.noresults-card").append(info);
					}
					error = error + 1;
				} else {
					$("div.noresults-card div.alert").remove();
					$(".list-a").remove();
					data.forEach(data => {
						estado = data['estado'];
						if (data['anexo'] != null && data['anexo'] != '') {
							anexo = data['anexo'];
						} else {
							anexo = null;
						}
						$("#row-table-protocols").show();
						data = new Date(data['data']);
						dia = data.getDate();
						if (dia.toString().length == 1) {
							dia = "0" + dia;
						}
						mes = data.getMonth() + 1;
						if (mes.toString().length == 1) {
							mes = "0" + mes;
						}
						ano = data.getFullYear();
						cdata = dia + "/" + mes + "/" + ano;
						tr1 = "<tr class='list-a'><td>" + estado + "</td><td>" + cdata + "</td><td>";
						if (anexo != '' && anexo != null) {
							tr2 = '<a data-image="' + anexo + '" class="open-img-modal btn btn-primary btn-table" data-toggle="tooltip" data-placement="left"title="Abrir anexo"><i class="material-icons text-white">image</i></a>';
						} else {
							tr2 = 'Sem anexo';
						}
						tr3 = "</td></tr>";
						tr4 = tr1 + tr2 + tr3;
						$("table#table-protocols tbody").append(tr4);
						$(".open-img-modal").on("click", function () {
							anexo = $(this).attr("data-image");
							$("#download-img").attr("download-link", "\\baixar/anexo/" + anexo);
							$("#redirect-btn").attr("data-image", anexo);
							$("img#img-md").attr("src", "\\uploads/" + anexo);
							$("a#img-link").attr("href", "\\uploads/" + anexo);
							$("#img-modal").modal()
						});
						error = 1;
					});
				}
			},
			error: function () {
				console.log("Erro - Não foi possível consultar o protocolo: " + code);
			}
		})
	};
	$("select#cliente").on("change", function () {
		id = this.value;
		$.ajax({
			type: 'post',
			url: '/admin/recuperar/protocolos/' + id,
			data: {},
			success: function (data) {
				data = $.parseJSON(data);
				$("select#protocolo").find('option').remove();
				data.forEach(data => {
					option = new Option(data.protocolo + ' - ' + data.servico, data.id);
					$("select#protocolo").append(option);
				});
			},
			error: function () {
				$("select#protocolo").find('option').remove();
				option = new Option("Selecione um cliente", null);
				$("select#protocolo").append(option);
				console.log("Erro - Cliente não encontrado.");
			}
		})
	});
});