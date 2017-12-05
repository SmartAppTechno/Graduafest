 <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Por favor inicie sesión</h3>
                    </div>
                    <div class="panel-body">
                        
                        <?php echo form_open('admin',array('role' => 'form')); ?>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Correo electronico" name="usuario" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="contraseña" type="password" value="">
                                </div>                          
                                
                                    <p><?php echo validation_errors(); ?></p>
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" name="submit" value="Login" class="btn btn-lg btn-success btn-block" />
                                <!--<a  type="submit" class="btn btn-lg btn-success btn-block">Login</a>-->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>