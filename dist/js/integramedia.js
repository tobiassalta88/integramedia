$(document).ready(function() {
    $('#example').DataTable();
    $('.date').datepicker({
      // endDate: 'today',
      autoclose: true,
      format: 'yyyy-mm-dd'
    });
    $('.select2').select2();
} );

function updateAge(date){
  // alert(date);
  birth_date = new Date(date);
  birth_year = birth_date.getFullYear();
  birth_month = birth_date.getMonth();
  birth_day = birth_date.getDate();

  today_date = new Date();
  today_year = today_date.getFullYear();
  today_month = today_date.getMonth();
  today_day = today_date.getDate();
  age = today_year - birth_year;

  if (today_month < birth_month) {
    age--;
  }
  if ((birth_month == today_month) && (today_day < birth_day)) {
    age--;
  }
  $('#inputAge').val(age + ' years');
}

function saveClient() {
  name = $('#inputName').val();
  last_name = $('#inputLastName').val();
  dni = $('#inputDNI').val();
  birthday = $('#inputBirthday').val();
  if ((name == "") || (last_name == "") || (dni == "") || (birthday == "")) {
    alertify.error('Missing complete data.');
  } else {
    $.ajax({
      type: 'POST',
      url: 'verifyDNI.php',
      data: "value=" + dni,
      success: function(response){
        if (response == 0) {
          $.ajax({
            type: 'POST',
            url:  'save.php',
            data: "name=" + name + "&last_name=" + last_name + "&dni=" + dni + "&birthday=" + birthday + "&credit_card=" + $('#inputCreditCard').val(),
            success: function(response){
              // alertify.alert('CONGRATULATIONS:', response);
              $(location).attr('href', '../clients.php');
             }
          });
        } else {
          alertify.alert('ERROR:','The DNI is duplicated.');
        }
       }
    });
  }
}

function editClient() {
  id = $('#inputID').val();
  name = $('#inputName').val();
  last_name = $('#inputLastName').val();
  dni = $('#inputDNI').val();
  birthday = $('#inputBirthday').val();
  console.log(id);
  if ((name == "") || (last_name == "") || (dni == "") || (birthday == "")) {
    alertify.error('Missing complete data.');
  } else {
    $.ajax({
      type: 'POST',
      url:  'editLoad.php',
      data: "id=" + id + "&name=" + name + "&last_name=" + last_name + "&dni=" + dni + "&birthday=" + birthday + "&credit_card=" + $('#inputCreditCard').val(),
      success: function(response){
        // alertify.alert('CONGRATULATIONS:', response);
        $(location).attr('href', '../clients.php');
       }
    });
  }
}

function deleteClient(id) {
  alertify.confirm('DELETE CLIENT:','Are you sure you want to delete it?', function(){
    $.ajax({
      type:"POST",
      data:"id=" + id,
      url: "./client/delete.php",
      success: function(r){
        $(location).attr('href', './clients.php');
      }
    });
    },function(){ alertify.error('Operation was canceled.')});
}

function saveEmployee() {
  name = $('#inputName').val();
  last_name = $('#inputLastName').val();
  dni = $('#inputDNI').val();
  birthday = $('#inputBirthday').val();
  file = $('#inputFile').val();
  if ((name == "") || (last_name == "") || (dni == "") || (birthday == "") || (file == "")) {
    alertify.error('Missing complete data.');
  } else {
    $.ajax({
      type: 'POST',
      url: 'verifyFile.php',
      data: "value=" + file,
      success: function(response){
        if (response == 0) {
          $.ajax({
            type: 'POST',
            url:  'save.php',
            data: "name=" + name + "&last_name=" + last_name + "&dni=" + dni + "&birthday=" + birthday + "&file=" + file,
            success: function(response){
              // alertify.alert('CONGRATULATIONS:', response);
              $(location).attr('href', '../employees.php');
             }
          });
        } else {
          alertify.alert('ERROR:','The file is duplicated.');
        }
       }
    });
  }
}

function editEmployee() {
  id = $('#inputID').val();
  name = $('#inputName').val();
  last_name = $('#inputLastName').val();
  dni = $('#inputDNI').val();
  birthday = $('#inputBirthday').val();
  console.log(id);
  if ((name == "") || (last_name == "") || (dni == "") || (birthday == "")) {
    alertify.error('Missing complete data.');
  } else {
    $.ajax({
      type: 'POST',
      url:  'editLoad.php',
      data: "id=" + id + "&name=" + name + "&last_name=" + last_name + "&dni=" + dni + "&birthday=" + birthday,
      success: function(response){
        // alertify.alert('CONGRATULATIONS:', response);
        $(location).attr('href', '../employees.php');
       }
    });
  }
}

function deleteEmployee(id) {
  alertify.confirm('DELETE EMPLOYEE:','Are you sure you want to delete it?', function(){
    $.ajax({
      type:"POST",
      data:"id=" + id,
      url: "./employee/delete.php",
      success: function(r){
        $(location).attr('href', './employees.php');
      }
    });
    },function(){ alertify.error('Operation was canceled.')});
}

function saveProvider() {
  name = $('#inputName').val();
  direction = $('#inputDirection').val();
  phone = $('#inputPhone').val();
  if ((name == "") || (direction == "") || (phone == "")) {
    alertify.error('Missing complete data.');
  } else {
    $.ajax({
      type: 'POST',
      url:  'save.php',
      data: "name=" + name + "&direction=" + direction + "&phone=" + phone,
      success: function(response){
        // alertify.alert('CONGRATULATIONS:', response);
        $(location).attr('href', '../providers.php');
       }
    });
  }
}

function editProvider() {
  id = $('#inputID').val();
  name = $('#inputName').val();
  direction = $('#inputDirection').val();
  phone = $('#inputPhone').val();
  if ((name == "") || (direction == "") || (phone == "")) {
    alertify.error('Missing complete data.');
  } else {
    $.ajax({
      type: 'POST',
      url:  'editLoad.php',
      data: "id=" + id + "&name=" + name + "&direction=" + direction + "&phone=" + phone,
      success: function(response){
        // alertify.alert('CONGRATULATIONS:', response);
        $(location).attr('href', '../providers.php');
       }
    });
  }
}

function deleteProvider(id) {
  alertify.confirm('DELETE PROVIDER:','Are you sure you want to delete it?', function(){
    $.ajax({
      type:"POST",
      data:"id=" + id,
      url: "./provider/delete.php",
      success: function(r){
        $(location).attr('href', './providers.php');
      }
    });
    },function(){ alertify.error('Operation was canceled.')});
}

function saveProduct() {
  name = $('#inputName').val();
  brand = $('#inputBrand').val();
  price = $('#inputPrice').val();
  id_provider = $('#inputProvider').val();
  expiration_date = $('#inputExpirationDate').val();
  if (id_provider == null) {
    alertify.error('Need to enter the provider.');
  } else {
    $.ajax({
      type: 'POST',
      url:  'save.php',
      data: "name=" + name + "&brand=" + brand + "&price=" + price + "&id_provider=" + id_provider + "&expiration_date=" + expiration_date,
      success: function(response){
        // alertify.alert('CONGRATULATIONS:', response);
        $(location).attr('href', '../products.php');
       }
    });
  }
}

function editProduct() {
  id = $('#inputID').val();
  name = $('#inputName').val();
  brand = $('#inputBrand').val();
  price = $('#inputPrice').val();
  id_provider = $('#inputProvider').val();
  expiration_date = $('#inputExpirationDate').val();
  $.ajax({
    type: 'POST',
    url:  'editLoad.php',
    data: "id=" + id + "&name=" + name + "&brand=" + brand + "&price=" + price + "&id_provider=" + id_provider + "&expiration_date=" + expiration_date,
    success: function(response){
      // alertify.alert('CONGRATULATIONS:', response);
      $(location).attr('href', '../products.php');
     }
  });
}

function deleteProduct(id) {
  alertify.confirm('DELETE PRODUCT:','Are you sure you want to delete it?', function(){
    $.ajax({
      type:"POST",
      data:"id=" + id,
      url: "./product/delete.php",
      success: function(r){
        $(location).attr('href', './products.php');
      }
    });
    },function(){ alertify.error('Operation was canceled.')});
}

function insertProduct(id, name, price){
  $('#idProduct').val(id);
  $('#nameProduct').val(name);
  $('#priceProduct').val(price.toFixed(2));
  $('#subtotal').val(price.toFixed(2));
  $('#btnAdd').prop('disabled', false);
  $('#btnAdd').focus();
}

function calcSubtotal(quantity){
  st = $('#priceProduct').val()*quantity;
  $('#subtotal').val(st.toFixed(2));
}

function addProduct(){
  product = $('#idProduct').val() + "|||" +
    $('#nameProduct').val() + "|||" +
    $('#quantityProduct').val() + "|||" +
    $('#priceProduct').val() + "|||" +
    $('#subtotal').val();
    console.log(product);
    $.ajax({
      type: 'POST',
      url: 'addProduct.php',
      data: "prod=" + product,
      success: function(r){
        $('#contTable').load("tableProducts.php");
      }
    });
}

function removeProduct(index){
	$.ajax({
		type:"POST",
		data:"i=" + index,
		url:"removeProduct.php",
		success:function(r){
			$('#contTable').load("tableProducts.php");
			alertify.error("The product was removed.");
		}
	});
}

function send() {
  c = $('#inputCliente').val();
  if (c == null) {
    alertify.alert('ERROR:','You must select a customer.');
  } else {
    $.ajax({
      type: 'POST',
      url:  'verify.php',
      success: function(response){
        if (response==0) {
          alertify.confirm('SEND:','Are you sure?', function(){
              $.ajax({
                type: 'GET',
                url:  'newLoad.php',
                data: 'c='+c,
                success: function(response){
                   console.log(response);
                   window.open('./pdf.php?i='+response);
                   location.reload();
                 }
              });
          },function(){ alertify.error('Cancelled.')});
        } else {
          alertify.alert('ERROR:',response);
        }
      }
    });
  }
}

function restart(){
  $.ajax({
    url:"reset.php",
    success:function(r){
      $('#contTable').load("tableProducts.php");
    }
  });
}
