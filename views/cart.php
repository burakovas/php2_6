  <div class="myCart" >
    <p>Это Корзина</p>
    <?php foreach ($data as $product): ?>
      <p><?= $product['tovId'] ?><span> = <?= $product['tovkol'] ?></span></p>
      <a href="/cart/del?id=<?=$product['id']?>">УДАЛИТЬ ИЗ КОРЗИНЫ</a>
    <?php endforeach; ?>
  </div>
