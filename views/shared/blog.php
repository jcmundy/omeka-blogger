<div class="blogger blog">

    <ul class="posts">
        <?php $count = 0; ?>
        <?php foreach($posts as $post):?>
            <?php 
                if($limit > 0 && $count >= $limit) {
                    break;
                }
                $count++;
            ?>
            <li class="post">
                <?php if($links): ?>
                    <span class="title">
                    <a href="<?php echo $post->link; ?>">
                    <?php if(is_array($post->title())): ?>
                      <?php $green = $post->title(); $blue = array_slice($green, -1, 1); $purple = print_r($blue, true); $pink = substr($purple, strpos($purple, "[textContent] => ")); $yellow = substr($pink, 16, -6);?>
                          <span style="font-size:130%"><?php echo substr($yellow, 0, 65);?><?php echo "..."?></span><br/>
                          <span style="font-size:80%"><?php echo $post->date();?></span>
                    </a>
                    <?php else: ?>
                    <a href="<?php echo $post->link; ?>">
                      <!-- <span style="font-size:130%"><?php /*echo $post->title();*/?></span><br/> -->
                        <span style="font-size:130%"><?php echo substr($post->title(), 0, 65);?><?php echo "..."?></span><br/>
                        <span style="font-size:80%"><?php echo substr($post->pubDate(), 0, 17);?></span>
                    </a>
                    <?php endif; ?>
                    <button class="accordion">Description</button>
                    <div class="panel">
                        <?php echo getFeedItemBody($post, $display); ?><br/>
                    </div>
                    </span>
                <?php else: ?>
                    <div class="title"><?php echo $post->title();?></div>
                    <button class="accordion">Description</button>
                    <div class="panel">
                        <?php echo getFeedItemBody($post, $display); ?><br/>
                    </div>
                <?php endif; ?>
            </li>

        <?php endforeach; ?>


    </ul>

    <?php if($more): ?>
        <div class="more-wrapper"><a class="more" href="<?php echo getFeedLink($posts); ?>">More</a></div>
    <?php endif; ?>
</div>

