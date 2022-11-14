<?php $fields = $object->getFields();?>

<?php if (isset($errors)) : ?>
    <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
<?php endif; ?>

<div class="form-group">
    <label><?php echo $fields['tag']['trans'];?>*</label>
    <?php echo erLhcoreClassAbstract::renderInput('tag', $fields['tag'], $object)?>
</div>
<div class="form-group">
    <label><?php echo $fields['intent']['trans'];?>*</label>
    <?php echo erLhcoreClassAbstract::renderInput('intent', $fields['intent'], $object)?>
</div>
<div class="btn-group" role="group" aria-label="...">
    <input type="submit" class="btn btn-secondary" name="SaveClient" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Save');?>"/>
    <input type="submit" class="btn btn-secondary" name="UpdateClient" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Update');?>"/>
    <input type="submit" class="btn btn-secondary" name="CancelAction" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('system/buttons','Cancel');?>"/>
</div>