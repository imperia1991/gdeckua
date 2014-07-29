<?php if (Yii::app()->user->hasFlash('success') || Yii::app()->user->hasFlash('error')): ?>
	<?php
		$message = '';
		$header = '';
		if (Yii::app()->user->hasFlash('success'))
		{
			$header = Yii::t('main', 'Сообщение');
			$theme = 'successMessage';
			$message = Yii::app()->user->getFlash('success');
		}
		elseif (Yii::app()->user->hasFlash('error'))
		{
			$header = Yii::t('main', 'Ошибка');
			$theme = 'errorMessage';
			$message = Yii::app()->user->getFlash('error');
		}

		if (!empty($message))
			echo '<script type="text/javascript">$.jGrowl("' . $message . '", { header: "' . $header . '", life: 15000, theme: "' . $theme . '" });</script>';
	?>

<?php endif; ?>