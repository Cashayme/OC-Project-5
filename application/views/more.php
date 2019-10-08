
<?php foreach($events->result() as $event) { ?>
                    <tr class="hidden">
                    <th scope="row"><img class="rounded-img" src="assets/images/uploaded_images/<?php if ($event->event_picture) {
                        echo html_escape( $event->event_picture );
                    } else {
                        echo "default.jpg";
                    }  ?>" alt="image de l'event"></th>
                    <td><?php echo html_escape($event->event_name) ?></td>
                    <td><?php echo html_escape($event->event_date) ?></td>
                    <td><?php echo html_escape($event->city_address) ?></td>
                    <td><a href="<?php echo ''.site_url('event/plan/'.$event->event_id.'').'' ?>"><button class="btn btn-primary">Voir l'évènement</button></a></td>
                    </tr>
<?php } ?>