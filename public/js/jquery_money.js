		$(document).ready(function(){
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': '{{ csrf_token() }}'
				}
			});

			$('#category').on('change', function(){
				let product = $(this).val();
				$.ajax({
					url: '{{ route("eMoney") }}',
					method: 'post',
					data: {product:product},
					beforeSend: function(){
						var select = `<option>Select Product!</option>`;
						$('#select_money').html(select);
					},
					dataType: 'json',
					success: function(data){
						data.msg.forEach(function(result){
							var product = `<option>${result.product_name}</option>`;
							$('#select_money').append(product);
						});
					}
				})
			})
		});