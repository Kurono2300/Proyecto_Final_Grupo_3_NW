<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'confirmet'): ?>
    <h3 class="w-100">¡Su pedido ha sido confirmado!</h3>
    <p>Por favor realice el pago a la cuenta bancaria "2100-0418-40-1234567891" para que su pedido sea procesado y enviado!</p>
    <p>O puede realizar el pago a traves del servicio de Paypal</p>
    <div id="response"></div>
    <div id="paypal-button"></div>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
        paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
        sandbox: 'AUGNtyHCMUAGFy11knA599uI6a65zavMsW62v43p-d9zKJjG4djHj-Km-AioLu_LuRYJalnwVcQPzfWE'
        },
        // Set up a payment
        payment: function(data, actions) {
        return actions.payment.create({
            transactions: [{
            amount: {
                total: <?php echo ($pedido->costo) + ($pedido->costo * 0.05); ?>,
                currency: 'USD'
            }
            }]
        });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
        return actions.payment.execute().then(function() {
            document.getElementById("response").style.display = 'inline-block';
            document.getElementById("response").innerHTML = 'Gracias por Realizar tu Pago!';
        });
        }
    }, '#paypal-button'); 
</script>

    <p class="w-100 text-left font-weight-bold">Id pedido: <?= $pedido->id ?></p>
    <p class="w-100 text-left font-weight-bold">Total a pagar: <?= $pedido->costo ?></p>
    <p class="w-100 text-left font-weight-bold">Productos: </p>

    <table class="table">
        <tr class="table-header">
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>
        <?php while  ($productoPedido = $producto->fetch_object()) : ?>
            <tr class="table-body">
                <?php if ($productoPedido->imagen != NULL): ?>
                    <td><img  src="<?= base_url ?>uploads/images/<?= $productoPedido->imagen ?>" width="80" alt=""></td>
                <?php else: ?>
                    <td><img class="" width="80" src="<?= base_url ?>assets/img/logosmashito.png" /></td>
                <?php endif; ?>
        <!--        <td><img src="<?= base_url ?>uploads/images/<?= $productoPedido->imagen ?>" alt="" width="80"</td>-->
                <td> <a href="<?= base_url ?>Productos/ver&id=<?= $productoPedido->id ?>"> <?= $productoPedido->nombre ?></a></td>
                <td><?= $productoPedido->precio ?></td>
                <td><?= $productoPedido->unidades ?></td>
            </tr>
        <?php endwhile; ?>
    </table>

<?php elseif (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'failet'): ?>
    <h3 class="w-100">Su pedido no puede ser realizado</h3>
    <p> Por favor revise sus datos para verificar posibles errores!! </p>

<?php endif; ?>