<?php /* Smarty version 2.6.29, created on 2019-05-20 10:05:49
         compiled from custom/modules/Calls/tpls/samples.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'custom/modules/Calls/tpls/samples.tpl', 42, false),array('modifier', 'cat', 'custom/modules/Calls/tpls/samples.tpl', 42, false),)), $this); ?>


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
<table width="100%" id="Samples">
    <col width="10%">
    <col width="30%">
    <col width="30%">
    <col width="29%">
    <form name="samples-information" id="samples-information" action="index.php" method="post">

    <tr>
        <td>
            <a href="#" id="add-sample" onclick="addSample();return false"><img src="/scrm/custom/modules/Calls/add.png" height="20" width="20"> </a>
        </td>
        <td>
            Sample Name
        </td>
        <td>
            Sample Lot
        </td>
        <td>
            Quantity
        </td>
    </tr>
        <?php $this->assign('val', 1); ?>

        <?php $_from = $this->_tpl_vars['selectedSamplesLotId']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['foo']):
?>
            <tr id="row-e-<?php echo $this->_tpl_vars['val']; ?>
">
                <td>
                    <a href='#' id='delete-<?php echo $this->_tpl_vars['val']; ?>
' onclick='deleteSample("e-<?php echo $this->_tpl_vars['val']; ?>
");return false'><img src='/scrm/custom/modules/Calls/delete.png' height='20' width='20'> </a>
                </td>
                <td><?php echo smarty_function_html_options(array('name' => "sample-name[]",'disabled' => true,'options' => $this->_tpl_vars['samplesLotName'],'selected' => $this->_tpl_vars['selectedSamplesId'][$this->_tpl_vars['foo']],'onchange' => ((is_array($_tmp=((is_array($_tmp="chooseSample(this.value,'e-")) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['val']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['val'])))) ? $this->_run_mod_handler('cat', true, $_tmp, "')") : smarty_modifier_cat($_tmp, "')"))), $this);?>

                </td>
                <td>
                    <select name="sample-lot[]" disabled=true id="sample-lot-e-<?php echo $this->_tpl_vars['val']; ?>
"><option value="null">-- none --</option>
                    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['samplesLotId'],'selected' => $this->_tpl_vars['selectedSamplesLotId'][$this->_tpl_vars['foo']]), $this);?>


                    </select> </td>
                <td><input name='sample-lot-quantity[]' disabled=true id='sample-lot-quantity' class='spinner' value='<?php echo $this->_tpl_vars['selectedSamplesLotQuantity'][$this->_tpl_vars['foo']]; ?>
'>
                </td>

            </tr>
            <?php $this->assign('val', $this->_tpl_vars['val']+1); ?>
        <?php endforeach; endif; unset($_from); ?>


</table>
<?php echo '
<script type="text/javascript">
    $( document ).ready(function() {
        $( ".spinner" ).spinner( "disable" );
    });
</script>
'; ?>
