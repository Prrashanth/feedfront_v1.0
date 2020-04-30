<title>feedfront.ai | Dashboard</title>
<div class="wrapper wrapper-content">
    <div class="container">
                <div class="row  border-bottom white-bg dashboard-header">

                    <div class="col-md-6">
                        <h2>Welcome <?php echo $this->session->userdata('username') ?></h2>
                        <!--<small>You have 42 messages and 6 notifications.</small>-->
                        <ul class="list-group clear-list m-t">
                            <li class="list-group-item fist-item">
                                <span class="float-right">
                                    +91 1234567890
                                </span>
                                 Feedback Phone Number
                            </li>
                            <li class="list-group-item">
                                <span class="float-right" id='mins'>
                                    
                                </span>
                                 Remaining Minutes
                            </li>
                        </ul>
                    </div>

            </div>
            </div>
</div>
<script>
    $(document).ready(function () {
        
        $.ajax({
            type: 'post',
            url: 'fetchmin',
            dataType: 'JSON',
            success: function (data) {
                $('#mins').html(data[0]['subval']+' mins');              
              // location.reload();
            }
          });
   
    });
</script>
