<?php
require_once("server/config.php");
function getPayments()
{
  $connection = mysqli_connect(DB_URL, DB_USERNAME, DB_PASSWORD, DB_NAME);

  $sql = "SELECT * FROM `dashdata`";

  return $connection->query($sql);
}

function getPaymentItem($ticketId)
{
  $connection = mysqli_connect(DB_URL, DB_USERNAME, DB_PASSWORD, DB_NAME);

  $sql = "SELECT * FROM `ticket_items` WHERE ticket_id = '$ticketId'";

  return $connection->query($sql);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./style.css">
  <title>Список чеков</title>
</head>

<body>
  <header class="header">
    <div class="header__content">
      <h1 class="header__title">Кассовые чеки</h1>
    </div>
  </header>
  <main class="main">
    <div class="main__content">
      <table class="main__table-tickets">
        <thead>
          <tr>
            <td>Идентификатор</td>
            <td>Название дирекции</td>
            <td>Название вокзала</td>
            <td>Место сделки</td>
            <td>Время сделки</td>
            <td>Наличные</td>
            <td>Безнал</td>
            <td>Тип операции</td>
            <td>Идентификатор операции</td>
            <td>Время сделки</td>
            <td>Кол-во</td>
            <td>field1</td>
            <td>isCorrect</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach (getPayments()->fetch_all() as $row): ?>
            <tr class="main__tr" data-id=" <?php echo $row[8] ?> ">
              <?php for ($i = 0; $i < 13; $i++) { ?>
                <td>
                  <?php echo $row[$i]; ?>
                </td>
              <?php } ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php foreach (getPayments()->fetch_all() as $row): ?>
      <div data-id=" <?php echo $row[8] ?> " class="modal">
        <div class="modal__content">
          <h1>Позиции чека
            <?php echo $row[8] ?>
          </h1>
          <div class="modal__table_div">
            <table class="modal__table-tickets-items">
              <thead>
                <tr>
                  <td>Идентификатор</td>
                  <td>Описание</td>
                  <td>Кол-во</td>
                  <td>Сумма</td>
                  <td>Сумма безнал</td>
                </tr>
              </thead>
              <tbody>
                <?php foreach (getPaymentItem($row[8])->fetch_all() as $rowItem): ?>
                  <tr>
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                      <td>
                        <?php echo $rowItem[$i] ?>
                      </td>
                    <?php } ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <button class="modal__close">Закрыть</button>
        </div>
      </div>
    <?php endforeach; ?>
  </main>
  <footer class="footer">
    <div class="footer__content">
      <p>
        © Дирекция Железнодорожных Вокзалов, 2009 - 2023 год<br>
      </p>
    </div>
  </footer>
  <script src="./script.js"></script>
</body>

</html>