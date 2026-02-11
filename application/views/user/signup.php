<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <div class="row">
        <?php if (isset($error)) : ?>
			<div class="col-sm-5 col-sm-offset-3">
				<div class="alert alert-danger" role="alert">
					<?php echo $error; ?>
				</div>
			</div>
		<?php endif; ?>
        
        <div class="col-sm-5 col-sm-offset-3">
            <div class="page-header">
                <h1>Signup</h1>
            </div>
            
            <?php echo form_open('auth/signup'); ?>
            <div class="form-group">
                <label for="username">Username</label>
                <?php echo form_error('username'); ?>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username" value="<?php echo set_value('username'); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <?php echo form_error('email'); ?>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo set_value('email'); ?>">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <?php echo form_error('password'); ?>
                <input type="password" class="form-control " id="password" name="password"
                    placeholder="Enter a password" value="<?php echo set_value('password'); ?>">
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirm password</label>
                <?php echo form_error('password_confirm'); ?>
                <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                    placeholder="Confirm your password" value="<?php echo set_value('password_confirm'); ?>">
            </div>
            <div class="form-group">
                <label for="choose_img">Choose your Avatar</label>
                <input type="file" id="avatar" name="avatar">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-default" value="Signup">
            </div>
            </form>
        </div>
    </div><!-- .row -->
</div><!-- .container -->