<?php
require "includes/db.php";
$query1 = mysqli_query($connection, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href ="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <?php
  if(isset($_POST['submit'])){
    $in = implode(', ',$_POST['id']);
    $query ="DELETE FROM users WHERE id IN ($in)";
    $result = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($connection));
  }
  ?>
  <form method="POST">
    <div class="row">
      <div class="col-md-12">
        <table class="table container table-bordered">
          <thead class="thead-dark">
            <tr>
              <th>
                <input type="checkbox" name="allid">
              </th>
              <th scope="col">id</th>
              <th scope="col">Name</th>
              <th scope="col">email</th>
              <th scope="col">password</th>
              <th scope="col">status</th>
              <th scope="col">timereg</th>
            </tr>
          </thead>
          <tbody>
            <?php while($row=mysqli_fetch_assoc($query1)): ?>
              <tr>
                <td>
                  <input type="checkbox" name="id[]" value="<?php echo $row['id'] ?>">
                </td>
                <?php foreach ($row as $rowvalue => $value): ?>
                  <td>
                    <?php echo $value; ?>
                  </td>
                <?php endforeach; ?>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
    <button type="submit" name="submit">Delete</button>
  </form>
  <script type="text/javascript">
  const buttons = document.querySelectorAll('input[name="id[]"]');
  const buttonsArray =  Array.from(buttons);
  const checkAll = document.querySelector('input[name="allid"]');
  checkAll.addEventListener('change', e => {
    if(checkAll.checked){
      buttonsArray.forEach( item => {
        item.checked = true;
        if(item.checked){
          let input = document.createElement('input');
          input.setAttribute('type', 'hidden');
          input.setAttribute('value', item.value);
          document.querySelector('form').insertAdjacentElement('beforeend', input);
        }else{
          const childrens = Array.from(ddocument.querySelector('form').children);
          childrens.forEach( it => {
            if(item.value === it.value){
              it.remove();
            }
            return item;
          })
        }
      });
    }
    else{
      buttonsArray.forEach( item => {
        item.checked = false;
        const childrens = Array.from(document.querySelector('form').children);
        childrens.forEach( it => {
          if(item.value === it.value){
            it.remove();
          }
          return item;
        })
        checkAll.checked = false;
      });
    }
  })
  buttonsArray.forEach( item => {
    item.addEventListener('change', e => {
      if(item.checked){
        let input = document.createElement('input');
        input.setAttribute('type', 'hidden');
        input.setAttribute('value', item.value);
        document.querySelector('form').insertAdjacentElement('beforeend', input);
      }else{
        const childrens = Array.from(document.querySelector('form').children);
        childrens.forEach( it => {
          if(item.value === it.value){
            it.remove();
          }
          return item;
        })
        checkAll.checked = false;
      }
    })
  })
</script>
</body>
</html>
