        <!-- Content -->
        <div id="content" class="<?php echo $scrollClass; ?>">
            <div id="pages" class="<?php echo $pageClass; ?>">
                
                <!-- Intro Page -->
                <article id="IntroPage">
                    <header><h1>Home / Intro</h1></header>

                    <h2>Find your ideal vacation</h2>
                    <iframe src="//player.vimeo.com/video/139996299?autoplay=0&amp;loop=0" class="video-player" id="vimeoplayer7821" width="534" height="300" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
                    <p class="details">G Adventures travel is the best way to get up-close and personal with your planet in a way you’d never manage on your own.</br>
                    Travelling with us means supporting local communities and helps make the world a little bit better for everyone.</p>
                    
                    <section class="submitSection">
                        <header><h1>Start Your Journey</h1></header>
                        <a class="startButton" href="index.php?p=step1">Start Searching</a>
                    </section>

                </article>
                <!-- / Intro Page -->

                <!-- TravelStyles Page (1) -->
                <article id="Step1TravelStylesPage">
                    <header><h1>Step1: Preferred Travel Styles</h1></header>

                    <h2>Preferred Travel Styles (1/3)</h2>
                    <p class="details">Click to select your preferred style(s) of travelling.</br>
                    Hover over them to see more details.</p>
                    
                    <form method="post">

                        <section class="travelstyles">
                            <header><h1>Travel Style Options</h1></header>

                            <?php foreach($travelstyles as $travelstyle){ ?>
                            
                            <article class="travelstyleTile <?php if(!empty($_SESSION['travelstyles']) && in_array($travelstyle['id'], $_SESSION['travelstyles'])){ echo 'checked'; } ?>" style="background-image: url('img/travelstyles/<?php echo $travelstyle['image']; ?>')">
                                <header><h1><?php echo $travelstyle['name']; ?></h1></header>
                                <div class="topBar">&nbsp;</div>
                                <div class="travelstyleInfo">
                                    <div class="flipButton">
                                        <a href="<?php echo $travelstyle['url']; ?>" target="_blank" class="front infoButton">&nbsp;</a>
                                        <div class="back checkedButton">&nbsp;</div>
                                    </div>
                                    <div class="hide"><input type="checkbox" class="chk" name="travelstyles[]" <?php if(!empty($_SESSION['travelstyles']) && in_array($travelstyle['id'], $_SESSION['travelstyles'])){ echo 'checked'; } ?> value="<?php echo $travelstyle['id']; ?>">&nbsp;</input></div>
                                    <div class="keywords">
                                        <p><?php echo $travelstyle['keyword1']; ?></p>
                                        <p><?php echo $travelstyle['keyword2']; ?></p>
                                        <p><?php echo $travelstyle['keyword3']; ?></p>
                                    </div>
                                </div>
                            </article>

                            <?php } ?>

                        </section>
                        
                        <section class="submitSection <?php if(empty($_SESSION['travelstyles'])){ echo "hidden"; } ?>">
                            <header><h1>Save Travel Styles</h1></header>
                            <input type="submit" name="submitTravelstyles" value="Save and Proceed" />
                        </section>

                    </form>

                </article>
                <!-- / TravelStyles Page (1) -->

                <!-- Interests Page (2) -->
                <article id="Step2InterestsPage">
                    <header><h1>Step2: Select Travel Interests</h1></header>

                    <h2>Swipe Travel Interests (2/3)</h2>
                    <p class="details">Swipe us some of your favourite interests so we can get to know you better.</p>

                    <form method="post">
                        
                        <section class="interestcards">
                            <header><h1>Travel Interests Swipable Cards</h1></header>

                            <ul class="stack">

                                <?php foreach($interests as $interest){ ?>

                                <li class="interestCard <?php if(!empty($_SESSION['interests']) && in_array($interest['id'], $_SESSION['interests'])){ echo 'interested'; } ?>" style="background-image: url('img/interests/<?php echo $interest['image']; ?>')">
                                    <div class="hide"><input type="checkbox" class="chk" name="interests[]" <?php if(!empty($_SESSION['interests']) && in_array($interest['id'], $_SESSION['interests'])){ echo 'checked'; } ?> value="<?php echo $interest['id']; ?>">&nbsp;</input></div>
                                    <h3 class="interestName"><?php echo $interest['name']; ?></h3>
                                </li>
                                
                                <?php } ?>

                            </ul>

                        </section>

                        <section class="submitSection <?php if(empty($_SESSION['interests'])){ echo "hidden"; } ?>">
                            <header><h1>Submit Travel Interests</h1></header>
                            <input type="submit" name="submitInterests" value="Save and Proceed" />
                        </section>

                    </form>

                </article>
                <!-- / Interests Page (2) -->

                <!-- Locations Page (3) -->
                <article id="Step3LocationsPage">
                    <header><h1>Step3: Desired Locations</h1></header>

                    <h2>Preferred Locales (3/3)</h2>
                    <p class="details">Tell us what kind of places you've always wanted to visit.</p>

                    <form method="post">
                        
                        <section class="locales hidden">
                            <header><h1>Locale Preferences</h1></header>

                            <?php foreach($locales as $locale){ ?>

                            <div class="localeTile <?php if(!empty($_SESSION['locales']) && in_array($locale['id'], $_SESSION['locales'])){ echo 'checked'; } ?>">
                                <img src="img/locations/<?php echo $locale['image']; ?>" alt="<?php echo $locale['name']; ?>"/></a>
                                <div class="hide"><input type="checkbox" class="chk" name="locales[]" <?php if(!empty($_SESSION['locales']) && in_array($locale['id'], $_SESSION['locales'])){ echo 'checked'; } ?> value="<?php echo $locale['id']; ?>">&nbsp;</input></div>
                                <h3 class="locale"><?php echo $locale['name']; ?></h3>
                            </div>

                            <?php } ?>

                        </section>
    
                        <section class="submitSection <?php if(empty($_SESSION['locales']) || $pageIndex != 3){ echo "hidden"; } ?>">
                            <header><h1>Save Preferred Locales</h1></header>
                            <input type="submit" name="submitLocales" value="Save and Finish" />
                        </section>

                    </form>

                </article>
                <!-- / Locations Page (3) -->

                <!-- WrapUp Page -->
                <article id="WrapUpPage">
                    <header><h1>Finish: Personal Data</h1></header>

                    <h2>Almost There</h2>
                    <p class="details">All we need now is some personal info.</p>

                    <form action="" method="post">

                        <section class="personalData">
                            <fieldset>
                                <label for="txtFullname">Full Name</label>
                                <input type="text" name="txtFullname" required placeholder="e.g. John Doe" id="txtFullname" <?php if(!empty($_SESSION['errors']['txtFullname'])){ echo "class=\"error\""; } ?> value="<?php if(!empty($_POST['txtFullname'])){ echo $_POST['txtFullname']; } ?>"/>
                                <label for="txtEmail">Email</label>
                                <input type="email" name="txtEmail" required placeholder="e.g. johndoe@hotmail.com" id="txtEmail" <?php if(!empty($_SESSION['errors']['txtEmail'])){ echo "class=\"error\""; } ?> value="<?php if(!empty($_POST['txtEmail'])){ echo $_POST['txtEmail']; } ?>"/>
                            </fieldset>
                        </section>

                        <section class="submitSection <?php if(!empty($_SESSION['errors'])){ echo "hidden"; } ?>">
                            <header><h1>Save Info and Reveal</h1></header>
                            <input type="submit" name="submitUseInfo" value="Calculate my ideal trip" />
                        </section>

                    </form>

                </article>
                <!-- / WrapUp Page -->

            </div>
        </div>
        <!-- / Content -->

        <script>var pageIndex = <?php echo $pageIndex; ?>;</script>