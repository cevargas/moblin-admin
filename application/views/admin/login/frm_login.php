<br />

view admin login

<br />


<?php echo validation_errors(); ?>


<?php echo form_open( base_url( 'admin/login' ), array( 'id' => 'form-login', 'method' => 'post' ) ); ?>
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo set_value('email');?>">
  </div>
  <div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
  </div>
  <div class="form-group">
      <div class="checkbox">
        <label>
          <input type="checkbox" name="lembrar" value="<?php echo set_value('lembrar');?>"> Lembrar senha
        </label>
      </div>
  </div>
  <div class="form-group">
    <div class="pull-left">
        <button type="submit" class="btn btn-default">Entrar</button>                       
    </div>
    <div class="pull-right">
        <a class="link" href="javascript:;">Recuperar senha</a>
    </div> 
  </div>
<?php echo form_close();?>


