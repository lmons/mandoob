<?php /* Smarty version 2.6.29, created on 2019-05-20 10:05:49
         compiled from custom/modules/Calls/tpls/keyMessages.tpl */ ?>

<div class="preload" style=" display: flex;position:fixed;
  z-index:99999;
  top:0;
  opacity:0.5;
  left:0;
  bottom:0;
  right:0;
  background:white;"><img src="/scrm/custom/modules/Calls/ajax-loader.gif" style=" width: 100px;
    height: 100px;
    margin: auto; ">
</div>
<table width="100%" id="keyMessages">
    <col width="30%">
    <col width="30%"
    <form name="samples-information" id="samples-information" action="index.php" method="post">


</table>
<?php echo '

'; ?>

<?php echo '
<script type="text/javascript">
    $( document ).ready(function() {
        setTimeout(function(){
        '; ?>

        <?php $_from = $this->_tpl_vars['keyMessages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['foo']):
?>

        <?php echo '
         $("#'; ?>
<?php echo $this->_tpl_vars['foo']; ?>
<?php echo '").trigger("click");
          $("#reaction-'; ?>
<?php echo $this->_tpl_vars['foo']; ?>
<?php echo '").val("'; ?>
<?php echo $this->_tpl_vars['reaction'][$this->_tpl_vars['foo']]; ?>
<?php echo '");
        '; ?>

        <?php endforeach; endif; unset($_from); ?><?php echo '   
        },2000)
        
    });
</script>
'; ?>