<?php
session_start();
if (isset($_SESSION['tTemp']) && count($_SESSION['tTemp'])>0) {
  return 0;
} else {
  echo 'There is no product.';
}
