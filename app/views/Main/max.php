<h1>ТОП 500 клиентов с максимальной суммой за все заказы, которые имеют статус [success]</h1>
<br>
    <?php if(!empty($data)):?>
        <table class="table table-bordered">
            <thead>
                <th>FirstName</th>
                <th>LastName</th>
				<th>Summa</th>
            </thead>
			<?php foreach($data as $client):?>
                <tr>
                    <td><?=$client['firstname'];?></td>
                    <td><?=$client['lastname'];?></td>
					<td><?=$client['summa'];?></td>
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