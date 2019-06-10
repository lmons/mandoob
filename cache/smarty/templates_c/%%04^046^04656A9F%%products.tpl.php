<?php /* Smarty version 2.6.29, created on 2019-05-20 10:05:49
         compiled from custom/modules/Calls/tpls/products.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'custom/modules/Calls/tpls/products.tpl', 21, false),)), $this); ?>

<?php echo '
    <script type="text/javascript">
        $( document ).ready(function() {
        '; ?>

        <?php $_from = $this->_tpl_vars['checkedProductId']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['foo']):
?>
        <?php echo '
            $("#'; ?>
<?php echo $this->_tpl_vars['foo']; ?>
<?php echo '").trigger("click");
        '; ?>

    <?php endforeach; endif; unset($_from); ?><?php echo '
        });
    </script>
'; ?>

<table width="100%">
    <?php unset($this->_sections['tr']);
$this->_sections['tr']['name'] = 'tr';
$this->_sections['tr']['loop'] = is_array($_loop=$this->_tpl_vars['assignedProductName']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tr']['step'] = ((int)$this->_tpl_vars['cols']) == 0 ? 1 : (int)$this->_tpl_vars['cols'];
$this->_sections['tr']['show'] = true;
$this->_sections['tr']['max'] = $this->_sections['tr']['loop'];
$this->_sections['tr']['start'] = $this->_sections['tr']['step'] > 0 ? 0 : $this->_sections['tr']['loop']-1;
if ($this->_sections['tr']['show']) {
    $this->_sections['tr']['total'] = min(ceil(($this->_sections['tr']['step'] > 0 ? $this->_sections['tr']['loop'] - $this->_sections['tr']['start'] : $this->_sections['tr']['start']+1)/abs($this->_sections['tr']['step'])), $this->_sections['tr']['max']);
    if ($this->_sections['tr']['total'] == 0)
        $this->_sections['tr']['show'] = false;
} else
    $this->_sections['tr']['total'] = 0;
if ($this->_sections['tr']['show']):

            for ($this->_sections['tr']['index'] = $this->_sections['tr']['start'], $this->_sections['tr']['iteration'] = 1;
                 $this->_sections['tr']['iteration'] <= $this->_sections['tr']['total'];
                 $this->_sections['tr']['index'] += $this->_sections['tr']['step'], $this->_sections['tr']['iteration']++):
$this->_sections['tr']['rownum'] = $this->_sections['tr']['iteration'];
$this->_sections['tr']['index_prev'] = $this->_sections['tr']['index'] - $this->_sections['tr']['step'];
$this->_sections['tr']['index_next'] = $this->_sections['tr']['index'] + $this->_sections['tr']['step'];
$this->_sections['tr']['first']      = ($this->_sections['tr']['iteration'] == 1);
$this->_sections['tr']['last']       = ($this->_sections['tr']['iteration'] == $this->_sections['tr']['total']);
?>
        <tr width="100%">
            <?php unset($this->_sections['td']);
$this->_sections['td']['name'] = 'td';
$this->_sections['td']['start'] = (int)$this->_sections['tr']['index'];
$this->_sections['td']['loop'] = is_array($_loop=$this->_sections['tr']['index']+$this->_tpl_vars['cols']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['td']['show'] = true;
$this->_sections['td']['max'] = $this->_sections['td']['loop'];
$this->_sections['td']['step'] = 1;
if ($this->_sections['td']['start'] < 0)
    $this->_sections['td']['start'] = max($this->_sections['td']['step'] > 0 ? 0 : -1, $this->_sections['td']['loop'] + $this->_sections['td']['start']);
else
    $this->_sections['td']['start'] = min($this->_sections['td']['start'], $this->_sections['td']['step'] > 0 ? $this->_sections['td']['loop'] : $this->_sections['td']['loop']-1);
if ($this->_sections['td']['show']) {
    $this->_sections['td']['total'] = min(ceil(($this->_sections['td']['step'] > 0 ? $this->_sections['td']['loop'] - $this->_sections['td']['start'] : $this->_sections['td']['start']+1)/abs($this->_sections['td']['step'])), $this->_sections['td']['max']);
    if ($this->_sections['td']['total'] == 0)
        $this->_sections['td']['show'] = false;
} else
    $this->_sections['td']['total'] = 0;
if ($this->_sections['td']['show']):

            for ($this->_sections['td']['index'] = $this->_sections['td']['start'], $this->_sections['td']['iteration'] = 1;
                 $this->_sections['td']['iteration'] <= $this->_sections['td']['total'];
                 $this->_sections['td']['index'] += $this->_sections['td']['step'], $this->_sections['td']['iteration']++):
$this->_sections['td']['rownum'] = $this->_sections['td']['iteration'];
$this->_sections['td']['index_prev'] = $this->_sections['td']['index'] - $this->_sections['td']['step'];
$this->_sections['td']['index_next'] = $this->_sections['td']['index'] + $this->_sections['td']['step'];
$this->_sections['td']['first']      = ($this->_sections['td']['iteration'] == 1);
$this->_sections['td']['last']       = ($this->_sections['td']['iteration'] == $this->_sections['td']['total']);
?>
                <?php if ($this->_tpl_vars['assignedProductId'][$this->_sections['td']['index']]): ?>
                    <td width="18%"><input type="checkbox" onclick="setSelectedProduct('<?php echo $this->_tpl_vars['assignedProductId'][$this->_sections['td']['index']]; ?>
')" id="<?php echo $this->_tpl_vars['assignedProductId'][$this->_sections['td']['index']]; ?>
" name="<?php echo $this->_tpl_vars['assignedProductName'][$this->_sections['td']['index']]; ?>
"><?php echo ((is_array($_tmp=@$this->_tpl_vars['assignedProductName'][$this->_sections['td']['index']])) ? $this->_run_mod_handler('default', true, $_tmp, "") : smarty_modifier_default($_tmp, "")); ?>

                    </td>
                <?php endif; ?>

            <?php endfor; endif; ?>
        </tr>
    <?php endfor; endif; ?>
</table>
<?php echo '
    <script>
        $( document ).ready(function() {
        $(".spinner").spinner({
            min: 0,
            max: 10
        });
        });
    </script>
'; ?>

