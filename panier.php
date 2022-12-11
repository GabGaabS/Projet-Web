

<?php

	class panier{
		 function getProducts(): array
		{
			return [
				[
					'name' => 'produit1',
					'price' => 2000

				],
				[
					'name' => 'produit2',
					'price' => 4000
				]
			];
		}


		function getTotal(): int
		{
			return array_reduce($this->getProducts(), fn(int $acc, array $products)=> $acc += $product, 0);

		}
	}
	
?>