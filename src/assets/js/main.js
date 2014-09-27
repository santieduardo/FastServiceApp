function formatNumber(number){
	return parseFloat(Math.round(number * 100) / 100).toFixed(2);
}


/**
 *  Catalogo Class
 */
function Catalogo(){
	var self = this;
	var produtos;
	var carrinho;
	var table;
	var total;
	var btn;
	
	var wait = true;
	var ajax = null;

	var createCarrinhoItem = function(produto){
		var tr = $('<tr></tr>').addClass('item').data('id', produto.idProduto);
		var nome = $('<td></td>').text(produto.nome);
		var qtd = $('<td></td>').append(
			$('<input>').attr({
				type: 'number',
				min: 0,
				value: produto.quantidade,
				required: 'required'
			})
		);
		var preco = $('<td nowrap="nowrap"></td>').text('R$ ' + formatNumber(produto.preco));
		var remove = $('<td><a class="close removerItem"><span aria-hidden="true">&times;</span></a></td>');
		
		tr.append(nome);
		tr.append(qtd);
		tr.append(preco);
		tr.append(remove);
		
		return tr;
	};
	
	var updateCarrinho = function(data){
		var size = data.produtos.length;

		if(size > 0){
			$('tr',table).remove();
			
			for(var i in data.produtos){
				var item = createCarrinhoItem(data.produtos[i]);
				item.appendTo(table);
				
			}

			bindCarrinho();
			total.text('R$ ' + formatNumber(data.total));
			btn.removeClass('disabled');
		} else {
			emptyCarrinho();
		}
		
		wait = false;
	};
	
	var emptyCarrinho = function(){
		$('tr',table).remove();
		table.append('<tr><td class="text-center" colspan="4"><br>Sem produtos no carrinho</td></tr>');
		total.text('R$ 0,00');
		btn.addClass('disabled');
	};
	
	
	var ajaxHandler = function(response, status, rq){
		if(response.status == 'OK'){
			updateCarrinho(response.data);
		}
	};
	
	var ajaxRemoveItem = function(id, all){
		ajax = $.ajax({
			type: 'GET',
			dataType: 'json',
			cache: false,
			data: {produtoId: id, deleteAll: all},
			url: URL.site + "catalogo/removeProduto",
			success: ajaxHandler,
			error: function(){
				alert('Ajax Error: removeProduto');
			}
		});
	};
	
	var ajaxAddItem = function(id){
		ajax = $.ajax({
			type: 'GET',
			dataType: 'json',
			cache: false,
			data: {produtoId: id},
			url: URL.site + "catalogo/addProduto",
			success: ajaxHandler,
			error: function(){
				alert('Ajax Error: addProduto');
			}
		});
	};
	
	var changeNumber = function(event){
		if(ajax != null)
			ajax.abort();
		

		var item = $(this);
		var value = item.data('lastValue');
		var newVal = item.val();
		var id = $(this).parents('tr.item').data('id');

		try {
			var newVal = parseInt(newVal);
			
			if(value < newVal){
				item.data('lastValue', newVal);
				ajaxAddItem(id);
			} else if(value > newVal){
				item.data('lastValue', newVal);
				ajaxRemoveItem(id, 0);
			}
		} catch (e) {}
	};
	
	var addItem = function(event){
		event.preventDefault();
		if(wait) return false;
		wait = true;
		
		var item = $(this).parents('div.thumbnail');
		ajaxAddItem(item.data('id'));
	};
	
	var removeItem = function(event){
		event.preventDefault();
		if(wait) return false;
		wait = true;
		
		var item = $(this).parents('tr.item');
		
		ajaxRemoveItem(item.data('id'), 1);
	};
	
	var bindProdutos = function(){
		var itens = $('a.adicionarItem', produtos);

		$.each(itens, function(key, value){
			var button = $(value);
			button.click(addItem);
		});
	};
	
	var bindCarrinho = function(){
		var itens = $('a.removerItem', table);

		$.each(itens, function(key, value){
			var button = $(value);
			var item = button.parents('tr.item');
			var number = item.find('input[type=number]');

			button.click(removeItem);

			number.data('lastValue', number.val());
			number.change(changeNumber);
		});
	};
	
	this.init = function(){
		produtos = $('#produtos');
		carrinho = $('#carrinho');
		table = $('#itens', carrinho);
		total = $('#total', carrinho);
		btn = $('#cart', carrinho);
		
		bindProdutos();
		bindCarrinho();
		
		wait = false;
	};
};


