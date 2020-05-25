		$(document).ready(function(){
			const unselect = `<option>Uncategorized Number</option>`;

			$('#pulsa').on('click', function(){
				$('#type').text('Pulsa Reguler');
				$('#type_product').val('pulsa');
				$('#price').val('');
				$('#select').html(unselect);
				$('#number').val('');
				$('#note').text('');
				$('#category').text('');
			});

			$('#kuota').on('click', function(){
				$('#type').text('Paket Data');
				$('#type_product').val('data');
				$('#price').val('');
				$('#select').html('');
				$('#select').html(unselect);
				$('#number').val('');
				$('#note').text('');
				$('#category').text('');
			});

			$('#voucher').on('click', function(){
				$('#type').text('Voucher Data')
				$('#type_product').val('vdata');
				$('#price').val('');
				$('#select').html('');
				$('#select').html(unselect);
				$('#number').val('');
				$('#note').text('');
				$('#category').text('');
			});

			$('#e-money').on('click', function(){
				let select = `<option>ok</option>`
				$("#select-money").append(select);
				$("#buyEmoney").prop('disabled', true);
				$('#priceMoney').prop('disabled', true);
				$('#note').text('');
				$('#category').text('');
			})

		});