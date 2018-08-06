<h1>ТОП 500 клиентов за последний год у которых нет ни одного заказа со статусом [success]</h1>
<br>
    <?php if(!empty($data)):?>
        <table class="table table-bordered">
            <thead>
				<th>Registration</th>
                <th>FirstName</th>
                <th>LastName</th>
            </thead>
			<?php foreach($data as $client):?>
                <tr>
					<td><?=$client['registration_date'];?></td>
                    <td><?=$client['firstname'];?></td>
                    <td><?=$client['lastname'];?></td>
                </tr>
			<?php endforeach;?>
        </table>
		<div class="clearfix"></div>
		<div class="text-center">
        <p>(<?=count($data)?> записей из <?=$total;?>)</p>
        <?php if($pagination->countPages > 1): ?>
            <?=$pagination;?>
        <?php endif; ?>
        </div>
    <?php else:?>
        <h2>Data empty</h2>
    <?php endif;?>