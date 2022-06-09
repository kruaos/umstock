 <div class="login-box-body">
            	<p class="login-box-msg">เข้าใช้งานระบบ</p>
               	<?=$this->session->flashdata('msgerr')?>
                <form method="post" action="<?php echo base_url('user/validlogin') ?>">
                    <div class="form-group has-feedback">
                        <input type="text" placeholder="Username" class="form-control" name="username">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Password" class="form-control" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button class="btn btn-primary btn-block btn-flat" type="submit">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>

            </div><!-- /.login-box-body -->