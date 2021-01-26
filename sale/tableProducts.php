<?php
session_start();
?>

<table class="table table-sm">
  <thead>
    <tr class="bg-warning">
      <th style="text-align:center">PRODUCT</th>
      <th>QUANTITY</th>
      <th style="text-align:center">UNIT PRICE</th>
      <th style="text-align:center">SUBTOTAL</th>
      <th style="text-align:center">ACTION</th>
    </tr>
  </thead>
  <tbody>
    <tr class="bg-light">
      <input type="hidden" id="idProduct" name="idProduct">
      <td>
        <input id="nameProduct" class="form-control input-sm" readonly>
      </td>
      <td>
        <input style="width:80px" id="quantityProduct" class="form-control input-sm" type="number" value="1" step="1" onchange="calcSubtotal(this.value)">
      </td>

      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fas fa-dollar-sign"></i>
            </span>
          </div>
          <input style="width:80px" id="priceProduct" class="form-control input-sm" type="number" readonly>
        </div>
      </td>
      <td>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">
              <i class="fas fa-dollar-sign"></i>
            </span>
          </div>
          <input style="width:80px" id="subtotal" class="form-control input-sm" type="number" readonly>
        </div>
      </td>
      <td style="text-align:center">
        <button style="border-radius:25px" class="btn btn-round btn-info" type="button" id="btnAdd" name="button" onclick="addProduct()" disabled><i class="fa fa-plus"></i></button>
      </td>
    </tr>
    <?php
      $total = 0;
      if (isset($_SESSION['tTemp'])):
          $i = 0;
    			foreach (@$_SESSION['tTemp'] as $key){
    				$a = explode("|||",@$key);
            $total += $a[4];
            ?>
            <tr>
              <th style="text-align:center"><?php echo $a[1]; ?></th>
              <th style="text-align:center"><?php echo $a[2]; ?></th>
              <th style="text-align:center"><?php echo '$ '.$a[3]; ?></th>
              <th style="text-align:center"><?php echo '$ '.$a[4]; ?></th>
              <th style="text-align:center;padding: 2px 0px 2px 0;">
                <span class="btn btn-danger btn-xs" onclick="removeProduct('<?php echo $i; ?>')">
                  <span class="fa fa-minus"></span>
                </span>
              </th>
            </tr>
            <?php
            $i++;
          }
      endif;
      $_SESSION['total'] = $total;
     ?>
  </tbody>
  <tfoot>
    <tr class="bg-black">
      <th colspan="2"></th>
      <th style="text-align:center"><h5>TOTAL</h5></th>
      <th>
        <h5 id="total" style="text-align:center"><?php echo '$ '.number_format($total,2) ?></h5>
      </th>
      <th></th>
    </tr>
  </tfoot>
</table>
