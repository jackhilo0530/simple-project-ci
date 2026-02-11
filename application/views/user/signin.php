<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="container">
    <?php if (isset($error)): ?>
        <div class="row">
            <div class="col-sm-5 col-sm-offset-3">
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row col-sm-5 col-sm-offset-3">
        <div class="page-header">
            <h1>Signin</h1>
        </div>
        <?php echo form_open('auth/signin') ?>
        <div class="form-group">
            <label for="username">Username</label>
            <?php echo form_error('username'); ?>
            <input type="text" class="form-control" id="username" name="username" placeholder="Your username"
                value="<?php echo set_value('username'); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <?php echo form_error('password'); ?>
            <input type="password" class="form-control" id="password" name="password" placeholder="Your password"
                value="<?php echo set_value('password'); ?>">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-default" value="Signin">
        </div>
        </form>
    </div>
</div><!-- .row -->
</div><!-- .container -->