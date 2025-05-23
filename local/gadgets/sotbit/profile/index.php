<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Loc::loadMessages(__FILE__);

Asset::getInstance()->addCss($arGadget['PATH_SITEROOT'].'/styles.css');
$idUser = intval($USER->GetID());

if (Loader::includeModule('sotbit.b2bcabinet') && $idUser > 0)
{?>
    <div class="widget_content widget_links personal_info">
        <?
        $user = new \Sotbit\B2bCabinet\Personal\User($idUser);
        $avatar = $user->genAvatar(array(
            'width' => 110,
            'height' => 110,
            'resize' => BX_RESIZE_IMAGE_EXACT
        ));
        ?>
        <div class="image_photo">
            <?
            if ($avatar['src'])
            {
                ?>
                <img src="<?= $avatar['src'] ?>" width="<?= $avatar['width'] ?>"
                     height="<?= $avatar['height'] ?>">
                <?
            }
            ?>
        </div>
        <div class="personal_information">
            <span class="display_block"><?php echo $user->getFIO(); ?></span>
            <?php
            if (strlen($user->getEmail()) > 0)
            {
            ?>
                <div>
                    <span class="email">
                        <?php echo Loc::getMessage('GD_SOTBIT_CABINET_EMAIL'); ?>
                    </span>
                    <span>
                        <?php echo $user->getEmail(); ?>
                    </span>
                </div>
            <?
            }
            if (strlen($user->getPersonalPhone()) > 0)
            {
            ?>
                <div>
                    <span class="phone">
                        <?php echo Loc::getMessage('GD_SOTBIT_CABINET_PHONE'); ?>
                    </span>
                    <span>
                        <?= $user->getPersonalPhone() ?>
                    </span>
                </div>
            <?
            } ?>
        </div>
    </div>
	<?php
}
?>
