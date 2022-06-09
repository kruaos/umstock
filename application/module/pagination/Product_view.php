
      <?php
      foreach($results as $data) {
          echo "{" . $data->id . "}" . $data->name . " - " . $data->price . "<br>";
      }
      ?>
         <p><?php echo $links; ?></p>
        </div>
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>