<h1>ТОП 500 заказов за последние три месяца, которые были созданы в будний день</h1>
<br>
    <?php if(!empty($data)):?>
        <table class="table table-bordered">
            <thead>
				<th>Order_Date</th>
                <th>FirstName</th>
                <th>LastName</th>
            </thead>
			<?php foreach($data as $client):?>
                <tr>
                    <td><?=$client['order_date'];?></td>
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