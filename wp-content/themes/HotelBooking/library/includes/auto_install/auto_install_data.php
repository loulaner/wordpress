<?php
set_time_limit(0);
global  $wpdb,$one_time_insert;
//require_once (TEMPLATEPATH . '/delete_data.php');
$dummy_image_path = get_template_directory_uri().'/images/dummy/';
/*
echo "<pre>";
print_r(get_option('sidebars_widgets'));
print_r(get_option('widget_pages'));
print_r(get_option('widget_catfirstpost_slider'));
exit; 

echo "<pre>";
print_r(get_option('sidebars_widgets'));
//print_r(get_option('widget_pages')); 

//print_r(get_option('widget_widget_templ_home_banner'));



exit; */


//====================================================================================//
/////////////// TERMS START ///////////////
//=============================CUSTOM TAXONOMY=======================================================//
$category_array = array('Blog');
insert_taxonomy_category($category_array);
function insert_taxonomy_category($category_array)
{
	global $wpdb;
	for($i=0;$i<count($category_array);$i++)
	{
		$parent_catid = 0;
		if(is_array($category_array[$i]))
		{
			$cat_name_arr = $category_array[$i];
			for($j=0;$j<count($cat_name_arr);$j++)
			{
				$catname = $cat_name_arr[$j];
				if($j>1)
				{
					$catid = $wpdb->get_var("select term_id from $wpdb->terms where name=\"$catname\"");
					if(!$catid)
					{
					$last_catid = wp_insert_term( $catname, 'category' );
					}					
				}else
				{
					$catid = $wpdb->get_var("select term_id from $wpdb->terms where name=\"$catname\"");
					if(!$catid)
					{
						$last_catid = wp_insert_term( $catname, 'category');
					}
				}
			}
			
		}else
		{
			$catname = $category_array[$i];
			$catid = $wpdb->get_var("select term_id from $wpdb->terms where name=\"$catname\"");
			if(!$catid)
			{
				wp_insert_term( $catname, 'category');
			}
		}
	}
	
	for($i=0;$i<count($category_array);$i++)
	{
		$parent_catid = 0;
		if(is_array($category_array[$i]))
		{
			$cat_name_arr = $category_array[$i];
			for($j=0;$j<count($cat_name_arr);$j++)
			{
				$catname = $cat_name_arr[$j];
				if($j>0)
				{
					$parentcatname = $cat_name_arr[0];
					$parent_catid = $wpdb->get_var("select term_id from $wpdb->terms where name=\"$parentcatname\"");
					$last_catid = $wpdb->get_var("select term_id from $wpdb->terms where name=\"$catname\"");
					wp_update_term( $last_catid, 'category', $args = array('parent'=>$parent_catid) );
				}
			}
			
		}
	}
}

/////////////// TERMS END ///////////////
$post_info = array();
//////////// Arts - Entertainment /////////////

////post start 1///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img1.jpg" ;
$post_meta = array(
				   "templ_seo_page_title" =>'A Toast for our Hotel',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'A Toast for our Hotel',
					"post_content" =>	'Its our Fifth anniversary, and you are invited. Thanks to you all, we have progressed much in this time. Lets have a toast for this. 
					
					Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. 
					
Edgar Allan Poe, author of "Annabel Lee" and "The Fall of the House of Usher" , is easily recognized as one of the foremost masters of horror and the macabre. His works have inspired terror and anxiety in many individuals, primarily through the use of heavy psychological tones, as opposed to the gore and blood themes used and abused by writers of his time. Poes collected works easily counts as some of the most frightening material ever written, especially now, in an age where horror movies are relegated to two hours of bloodshed and senseless violence, lacking any true horror and relying solely on shock value to appear "scary." Poe also stands out as being among the few who can make even the most mundane things seem utterly terrifying, a feat emulated by Stephen King and several Japanese horror authors, but never truly duplicated.

In a completely different vein of horror from his predecessors, and arguably creating a sub-genre of horror through his works, H. P. Lovecraft also stands out. His works, while lacking in humanity, are difficult to see as anything but terrifying, particularly because of the apparent lack of humanity in them. In contrast to writers of previous generations, Lovecraft focused more on the truly monstrous, ignoring the human element that most horror writers tended to insert into their works since the days of the Gothic era. His stories were littered with monsters that knew neither morality nor mercy, seeing humanity as insignificant insects and, in Lovecrafts malignant world of ancient races and Elder Gods, humanity was insignificant. He also brought back something from the Gothic horror era, showing his readers that knowledge, even just a little knowledge, can lead to the most terrifying of discoveries. This is perhaps best exemplified by the so-called "Cthulhu Mythos," a collection of stories that centered around Lovecrafts anti-mythological beings.

<h3>Frankenstein</h3>
<ol>
	<li>Among the most enduring horror classics in the world is that of Shelleys "Frankenstein," which combines the elements of horror with the intrinsic questions that plagued morality and philosophy at the time. </li>
	<li>In some ways, the story is one that puts a new spin on the old ghost story, in that the "ghost" is inevitably caused by the actions of mortal men who meddled in things they were not meant to. </li>
	<li>The story, aside from being a genuine tale of terror, also took on the role of a lesson in morality and the limits to just how far medical science could go.</li>
	<li>Prolonging life is one thing, but bringing back the dead is another thing entirely, which is one of the subtle messages of the novel.</li>
	<li>The underlying question of whether or not Frankensteins creature is the monster, or if it is Frankenstein himself, also contributes to making the story a memorable, chilling tale.</li>
</ol> 

However, very few stories can truly stand up against the pure terror and the subtle anxiety and dread caused by Bram Stokers infamous novel, "Dracula." The novel is a hallmark of the Gothic horror era, presenting a villain of potentially epic scope in the guise of a remarkable gentleman and nobleman. It deviated from other vampire stories of the time in that the vampire, Dracula, was not monstrous in appearance. He looked every inch a master and nobleman, establishing the "lord of the night" archetype that would be a stock image of vampire characters in literature for centuries to come. It also had all the elements necessary to both frighten readers and keep them coming back for more, marking it as the most enduring horror novel in history.

',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')
					);
////post end///
//====================================================================================//
////post start 2///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img2.jpg" ;
$post_meta = array(
				   "templ_seo_page_title" =>'Reserve your Hotel Table Now',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'Reserve your Hotel Table Now',
					"post_content" =>	'If you have not done it yet, then now is the time. Book your Hotel table now, and give that special feeling to your loved ones. Table would be reserved on first come first serve basis.
					
					There are great deals of important factors that go into getting a tattoo, including where your tattoo belongs on your body. Different tattoos have different story and importance behind it. Eagle tattoos are one of them that reflect strength and are the common choices for men and women who serve as police officers, firefighters, soldiers, or other service members. Emphasizing articulates such as freedom, strength, and liberty are popular choices added to banners or underneath a tattoo of an eagle particularly if the tattoo is done as a memorial or tribute to someone to make the whole image impressive.
					
Eagles are counted among the birds of strength with strong talon that soars high in the sky and possess keen eyesight. The images of eagles hold an important position in history also. They appeared in various emblems of the past history in many different lands and their importance have been mentioned in different historical events of the past. For instance in Native American cultures, the free-spirited eagle are deeply profoundly honored and their feathers were also given importance. They were often given as a sign of pride, security or friendship. Even in ancient Greece eagle was worshiped as it was thought to have some association with the god Sun. You can also find the name of the eagle has been mentioned in the Norse mythology. It had some association with the god Odin, who represented wisdom.

<h3>Feature</h3>
<ol>
	<li>Eagle tattoos are unique in themselves and it can be also done in many different creative ways and just about anywhere on the body but still the most common area for this type of tattoo is the upper arm, followed by the shoulders, and the upper and lower back areas.</li>
	<li>Eagle tattoos whether it is with spread wings or roosting position are really eye-catching.</li>
	<li>The most important feature of eagle tattoo is its feather. </li>
	<li>So if the tattoo is done on a large area with spread wings where every details of the wing are clearly visible provides the eagle tattoo with a realistic appearance. </li>
	<li>The back is a great location for eagle tattoo with their wings fully spread as if in flight. </li>
	<li>You can also ink your back with another popular swooping pose of an eagle. </li>
	<li>This swooping poses of the eagle targeting its prey with sharp talons is really mind blowing, and of course the internet and many tattoo shops are full of images of the majestic eagle in varying poses.</li>
</ol> 

Small eagle tattoos featuring only the head of the bird can be inked on the leg or armbands, or can be incorporated into another design. There are many tattoo shops and websites that will provide you with varying poses of eagle.

',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')
					);
////post end///
//====================================================================================//
////post start 3///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img3.jpg" ;
$post_meta = array(
				   
				   "templ_seo_page_title" =>'Hotel Designing that works',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'Hotel Designing that works',
					"post_content" =>	'I think what really matters is designing something which the majority of the public would be happy paying to stay in. I would never stay in an old fashioned hotel out of choice, I prefer modern stylish hotels. I think a lot of people are going the same way these days, they like a lack of clutter which they probably have plenty of at home. Calligraphy and painting were two of the most prized art forms in antediluvian China. Calligraphy was thought to be the highest and purest form of painting. The annals of painting in China dates back to the 2nd century BCE. In the earliest era, painting and writing were made out on silk, until paper was subsequently developed during the 1st century CE.
					
Chinese art, and in particular, Chinese painting is greatly treasured around the globe. Chinese painting can be retraced to as far back as six thousand years ago in the Neolithic Age when the Chinese have started using brushes in their paintings. Chinese art dates back even sooner than that.

According to subject matter, Chinese paintings can be classified as landscapes, character paintings and flower-and-bird paintings. In traditional Chinese painting, Chinese landscape painting embodies a major category, depicting nature, especially mountains and bodies of water. Landscapes have customarily been the choice of the Chinese because they manifest the poetry characteristic in nature. Accordingly, many esteemed paintings are landscapes.

The most popularly known form of Chinese painting is "Water-ink" painting, where water-ink is the medium. Some of the basic things required for the Chinese painting include: paper, brush, ink or ink stick, ink stone, and color.

<ol>
	<li>Brush: The Chinese brush is a mandatory tool for Chinese painting. The brush should be sturdy and pliable. Two types of brushes are used. The more delicate brush is created from white sheep hair. This brush should be soaked first, and then dried to prevent curling. The second one is made from fox or deer sable fibers, which are very durable, and is inclined to paint better. The procedure the brush is used depends on the varied features of brush strokes one wants to obtain, such as weight, lightness, gracefulness, ruggedness, firmness, and fullness. Various forms of shades are applied to impart space, texture, or depth.</li>
	<li>Ink Stick: There are three types of Ink Stick: resin soot, lacquer soot, and tung-oil soot. Of the three, tung-oil soot is the most commonly used. Otherwise, Chinese ink is best if ink stick or ink stone are ineffectual.</li>
	<li>Paper: The most generally used paper is Xuan paper, which is fabricated of sandalwood bark. This is exceptionally water retentive, so the color or ink disperses the moment the brush stroke is put down. The second most well-known is Mian paper.</li>
	<li>Color: The most former Chinese paintings used Mo, a type of natural ink, to produce monochromatic representations of nature or day-to-day life. Made of pine soot, mo is combined with water to get unique shades for conveying appropriate layers or color in a painting.</li>
</ol> 

Chinese painting is called shui-mo-hua. Shui-mo is the combination of shui (water) and mo. There are two styles of Chinese painting. They are gong-bi or detailed style, and xie-yi or freehand style. The second is the most common, not only since the objects are depicted with just a few strokes, but likewise because shapes and sprites are drawn by uncomplicated curves and natural ink. Many ancient poets and students used xie-yi paintings to give tongue to their religious anguish.
',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')
					);
////post end///
//====================================================================================//
////post start 4///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img4.jpg" ;
$post_meta = array(
				   
				   "templ_seo_page_title" =>'The Beautiful Rooms',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'The Beautiful Rooms',

					"post_content" =>	'Famous Paintings have been greatly admired in art history. Famous art paintings are invaluable and of great historic importance. Famous artists have been successful in creating famous artwork paintings. Canvas oil paintings make the most the popular form of the most famous Oil paintings. Famous Oil Paintings are of various styles. These include famous landscape paintings, famous still life paintings, famous fruit paintings, famous seascape paintings, famous contemporary paintings.
					
Famous artists paintings have earned world wide recognition in different periods of times. Famous painters paintings truly an asset for fine arts. There have been a great number of famous painters in different parts of the world in different periods of times. These include Marc Chagall, Salvador Dali, Leonardo Da Vinci, Paul Klee, Henri Matisse,Claude Monet, Pablo Picasso,Pierre Auguste Renoir,Henri Rousseau,Henri de Toulouse-Lautrec,Vincent Van Gogh,Andy Warhol.

<h3>Yo Picasso</h3>
<ol>
	<li>Famous abstract paintings present the fine art at the highest level. </li>
	<li>Famous abstract artists have been gratly greatly appreciated for their famous abstract oil paintings. </li>
	<li>Picasso is one of the most famous abstract painter. Picasso became very famous because he work in multiple styles.</li>
	<li>Famous paintings of Picasso are Guernica ,Three Musicians,The Three Dancers and Self Portrait: Yo Picasso.</li>
	<li>Picasso famous paintings have earned him worldwide recognition.</li>
</ol> 

Many famous flower paintings have been created by the outstanding flower painters. Famous Floral Oil Paintings are in wide range of styles. Famous floral fine art paintings are exquisite. Famous landscape paintings are the master pieces of fine art. Famous Landscape painters have created a great number of famous landscape paintings. Famous Landscape art has greatly been admired in all the periods of times. Famous contemporary landscape painters have successfully attained the mastery in the landscape art.

Still life fruit paintings and fruit bowl paintings make the famous fruit paintings. The highly skilled artists have also created the most famous paintings of rotting fruit. The modern famous artists are successful creating the masterpieces of still fruit oil paintings and oil pastel fruit paintings.

Famous still Life art depicts drinking glasses, foodstuffs, pipes, books and so on. Famous Still life paintings are indeed the master pieces of fine art. Woman portrait paintings make the famous portrait paintings. There are also famous portrait paintings of men. Famous portrait paintings of Oscar dela hova have been greatly appreciated. Japanese women portrait paintings are very popular in Japanese culture. In addition to women portrait paintings and portrait paintings of men, there are many famous pet portrait paintings and famous portrait paintings of houses and famous paintings of sports cars.

Famous Islamic paintings of holy places and the famous islamic calligraphy of the holy verses have been truly represent the muslim art. Famous muslim artists have developed mastery of Islamic art calligraphy. The famous Islamic paintings include the paintings of the Holy places such as Khana kaaba, Masjid-e-Nabvi and other famous mosques and shrines. Famous Islamic art is fascinating and has always been appreciated. The famous Islamic art galleries have produced a great number of famous muslim painters and famous muslim calligraphist.

Famous modern galleries have produced the famous contemporary artists who have created many famous contemporary paintings. Famous oil paintings reproduction are also created in these famous galleries.

In addition to above styles, there are many famous paintings of other subjects. These include famous war paintings, famous paintings of jesus, famous figure paintings, religious famous paintings, famous paintings romantic, famous battle paintings, famous military paintings, famous sunset paintings, famous paintings of women, famous paintings of love, famous water paintings, famous acrylic paintings, famous paintings of buildings, famous dance paintings, famous dragon paintings, famous black paintings, famous paintings in the fall, famous paintings of cats, famous paintings of children, famous paintings of friends, famous paintings of christinaity, famous paintings of jesus and famous paintings of humanity. There are also famous native American paintings and famous Spanish paintings.

',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')
					);
////post end///
//====================================================================================//
////post start 5///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img5.jpg" ;
$post_meta = array(
				   "templ_seo_page_title" =>'The 5 Star Experience is here',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'The 5 Star Experience is here',
					"post_content" =>	'Good news for you all and for us as well. Our Hotel is now 5 star hotel. Yes, you read it right. Now theres definitely a reason to visit us. Art theft is an ancient and complicated crime. When you look at the some of the most famous cases of art thefts in history, you see thoroughly planned operations that involve art dealers, art fakers, mobsters, ransoms, and millions of dollars. Here you can read about some of the most famous cases of art theft in the history.

<h3>The First Theft:</h3>
The first documented case of art theft was in 1473, when two panels of altarpiece of the Last Judgment by the Dutch painter Hans Memling were stolen. While the triptych was being transported by ship from the Netherlands to Florence, the ship was attacked by pirates who took it to the Gdansk cathedral in Poland. Nowadays, the piece is shown at the National Museum in Gdansk where it was recently moved from the Basilica of the Assumption. The Most Famous Theft:
The most famous story of art theft involves one of the most famous paintings in the world and one of the most famous artists in history as a suspect. In the night of August 21, 1911, the Mona Lisa was stolen out of the Louver. Soon after, Pablo Picasso was arrested and questioned by the police, but was released quickly.

It took about two years until the mystery was solved by the Parisian police. It turned out that the 30x21 inch painting was taken by one of the museum employees by the name of Vincenzo Peruggia, who simply carried it hidden under his coat. Nevertheless, Peruggia did not work alone. The crime was carefully conducted by a notorious con man, Eduardo de Valfierno, who was sent by an art faker who intended to make copies and sell them as if they were the original painting.

While Yves Chaudron, the art faker, was busy creating copies for the famous masterpiece, Mona Lisa was still hidden at Peruggias apartment. After two years in which Peruggia did not hear from Chaudron, he tried to make the best out of his stolen good. Eventually, Peruggia was caught by the police while trying to sell the painting to an art dealer from Florence, Italy. The Mona Lisa was returned to the Louver in 1913.

<h3>The Biggest Theft in the USA:</h3>
The biggest art theft in United States took place at the Isabella Stewart Gardner Museum. On the night of March 18, 1990, a group of thieves wearing police uniforms broke into the museum and took thirteen paintings whose collective value was estimated at around 300 million dollars. The thieves took two paintings and one print by Rembrandt, and works of Vermeer, Manet, Degas, Govaert Flinck, as well as a French and a Chinese artifact.

As of yet, none of the paintings have been found and the case is still unsolved. According to recent rumors, the FBI are investigating the possibility that the Boston Mob along with French art dealers are connected to the crime.

<h3>The Scream:</h3>
The painting by Edvard Munchs, The Scream, is probably the most sought after painting by art thieves in history. It has been stolen twice and was only recently recovered. In 1994, during the Winter Olympics in Lillehammer, Norway, The Scream was stolen from an Oslo gallery by two thieves who broke through an open window, set off the alarm and left a note saying: thanks for the poor security.

Three months later, the holders of the painting approached the Norwegian Government with an offer: 1 million dollars ransom for Edvard Munchs The Scream. The Government turned down the offer, but the Norwegian police collaborated with the British Police and the Getty Museum to organize a sting operation that brought back the painting to where it belongs.

Ten years later, The Scream was stolen again from the Munch Museum. This time, the robbers used a gun and took another of Munchs painting with them. While Museum officials waiting for the thieves to request ransom money, rumors claimed that both paintings were burned to conceal evidence. Eventually, the Norwegian police discovered the two paintings on August 31, 2006 but the facts on how they were recovered are not known yet.
',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')
					);
////post end///
//====================================================================================//
////post start 6///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img6.jpg" ;
$post_meta = array(
				   
				   "templ_seo_page_title" =>'Soothe While You Shine with These Lip Balm/Lip Gloss Hybrids ',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'Soothe While You Shine with These Lip Balm/Lip Gloss Hybrids',
					"post_content" =>	'As the weather warms up and we are slowly but surely getting enticed to brave the sunny outdoors for summery activities, it is always important to make sure to be adequately protected from the sun. And while it may be easy to remember slathering on SPF for all your vital exposed skin, its also important to give proper attention to. Selecting art for your home can be an exciting adventure and a source of enjoyment for years to come. Keys to success are figuring out what kind of art you like, how it will fit in with the rest of your interior design plans, and how to exhibit the art to the best effect in your home.
					
<h3>What kind of art do you like?</h3>
There are many opportunities to browse art within your community at local exhibitions, art fairs and galleries. Even small towns usually have a not-for-profit gallery space, or cafes and restaurant that exhibit local artists. In larger cities, galleries often get together for monthly or periodic "gallery nights" where all the galleries hold open house receptions on the same evening. Its a great way to see a lot of art in a short time.

Today the internet provides the largest variety and depth of fine art available worldwide. You can visit museum websites and see master works from ages past, check out online galleries for group shows, and visit hundreds of individual artists websites. One advantage of using the internet is that you can search for the specific kind of art you are interested in, whether its photography, impressionism, bronze sculpture, or abstract painting. And when you find one art site, youll usually find links to many, many more.

<h3>Should the art fit the room or the room fit the art?</h3>
If you feel strongly about a particular work of art, you should buy the art you love and then find a place to put it. But you may find that when you get the art home and place it on a wall or pedestal, it doesnt work with its surroundings. By not "working," I mean the art looks out of place in the room. Placing art in the wrong surroundings takes away from its beauty and impact.

What should you do if you bring a painting home and it clashes with its environment? First, hang the painting in various places in your home, trying it out on different walls. It may look great in a place you hadnt planned on hanging it. If you cant find a place where the art looks its best, you may need to make some changes in the room, such as moving furniture or taking down patterned wallpaper and repainting in a neutral color. The changes will be worth making in order to enjoy the art you love.

Sometimes the right lighting is the key to showing art at its best. You may find that placing a picture light above a painting or directing track lighting on it is all the art needs to exhibit its brilliance. If you place a work of art in direct sunlight, however, be sure it wont be affected by the ultraviolet light. Pigments such as watercolor, pencil and pastel are especially prone to fading. Be sure to frame delicate art under UV protected glass or acrylic.

<h3>How to pick art to fit the room.</h3>
Size and color are the two major criteria for selecting art to fit its surroundings. For any particular space, art that is too large will overwhelm, and art that is too small will be lost and look out of proportion. The bolder the art, the more room it needs to breathe.

As a rule, paintings should be hung so that the center of the painting is at eye level. Sculpture may sit on the floor, a table, or pedestal, depending on the design. Rules should be considered guidelines only, however, so feel free to experiment.

When selecting a painting to match color, select one or two of the boldest colors in your room and look for art that has those colors in it. Youre not looking for an exact match here. Picking up one or two of the same colors will send a message that the painting belongs in this environment.

Another possibility for dealing with color is to choose art with muted colors, black-and-white art, or art that is framed in a way that mutes its color impact in the room. A wide light-colored mat and neutral frame create a protected environment for the art within.

Style is another consideration when selecting art to fit a room. If your house is filled with antiques, for example, youll want to use antique-style frames on the paintings you hang there. If you have contemporary furniture in large rooms with high ceilings, youll want to hang large contemporary paintings.

<h3>How to create an art-friendly room.</h3>
Think about it. When you walk into a gallery or museum, what do they all have in common? White walls and lots of light. If a wall is wall-papered or painted a color other than white, it limits the choices for hanging art that will look good on it. If a room is dark, the art will not show to its best advantage.

If you want to make art the center of attraction, play down the other elements of the room like window coverings, carpeting, wall coverings, and even furniture. A room crowded with other colors, textures and objects will take the spotlight away from the art. Follow the principle that less is more. Keep it spare and let the art star. Then relax and enjoy it.

Selecting and displaying art is an art in itself. Experiment to learn what pleases you and what doesnt. Youll be well-rewarded for the time you invest by finding more satisfaction both in the art and in your home.
',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')
					);
////post end///
//====================================================================================//
////post start 7///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img7.jpg" ;
$post_meta = array(
				   
				   "templ_seo_page_title" =>'Take advantage of our Spa',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'Take advantage of our Spa',
					"post_content" =>	'You are invited to take advantage of Hotel Spa, and feel the goodness - discover yourself. Have that special massage and feel special.
					
					Contemporary art paintings are the true representatives of the modern art. Contemporary artists are creating the contemporary oil paintings of the high quality. A great number of contemporary oil paintings are available in the contemporary art gallery. Contemporary art is of great artistic importance. Contemporary abstract paintings make the most of contemporary art. Still life Contemporary paintings are also very much appreciated.
					
There are many museums of modern paintings all over the world. The modern paintings of the modern artists are exhibited in these museums. These museums of modern art have been successful in flourishing the contemporary art. Modern artists exhibit their modern paintings creations in the museum of contemporary art. Museum of modern art New york, Contemporary art museum Houston, museum of modern art paris, art museum of Fort worth are the famous museums of contemporary art. Contemporary art work can be seen in these modern art museums.These museums exhibit the popular contemporary paintings of the famous modern artists.

<h3>Modern Abstract Art</h3>
<ol>
	<li>There are great number of painters of modern life. </li>
	<li>They have created the modern abstract art on modern themes. </li>
	<li>Modern artists paint colours in an artistic way. </li>
	<li>Their contemporary oil paintings are pure form of fine arts. </li>
	<li>History of modern art is full of great contemporary paintings from famous modern artists. </li>
	<li>19th century paintings and 20th century paintings are worth seeing. </li>
	<li>Modern art movements have been in progress in recent times. </li>
	<li>There are many contemporary art centers. </li>
	<li>Contemporary art center Cincinnati and Contemporary art center of Virginia are the famous modern art center. </li>
	<li>St.Louis contemporary art has been very much appreciated. Contemporary Christian artists</li>
<ol>

Modern art is also available for sale. Modern and contemporary art can be purchased from the modern art gallery. These contemporary art galleries offer the Original modern paintings of the famous contemporary artist. The reproductions of the famous contemporary paintings can also be purchased from these modern art galleries. These galleries also offer cheap price modern oil paintings.

Good News for lovers of modern art ! You can get Contemporary and Modern Oil Paintings of your own choice just by selecting the Model number of the Landscape Oil Painting or by sending the Photo of your required image. Our highly skilled modern artists can reproduce the contemporary paintings as per your given photo. Just click the Link of Contemporary paintings on our website (www.paintingsgifts4u.com) . For more details, Please contact us at : info@paintingsgifts4u.com.
',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')
					);
////post end///
//====================================================================================//
////post start 8///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img8.jpg" ;
$post_meta = array(
				   
				   "templ_seo_page_title" =>'Why hotel design directly affects the prices you can charge',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'Why hotel design directly affects the prices you can charge',
					"post_content" =>	'Martin Soler told me something that caught my attention In my opinion, hotel design is worth at least 40 percent of a propertys marketing value. As he is someone who manages the marketing for some of the trendiest hotels in Europe, I value his opinion. In this guest article, Martin explains how he came to this conclusion.
					
					While the world pays respectful tribute to Rembrandt Van Ryn the artist, it has been compelled to wait until comparatively recent years for some small measure of reliable information concerning Rembrandt Van Ryn the man. Rembrandt Van Ryn was born in the pleasant city of Leyden, but it is not easy to name the precise year. Somewhere between 1604 and 1607 he started his troubled journey through life, and of his childhood the records are scanty. Doubtless, his youthful imagination was stirred by the sights of the city, the barges moving slowly along the canals, the windmills that were never at rest, the changing chiaroscuro of the flooded, dyke-seamed land. Perhaps he saw these things with the large eye of the artist, for he could not have turned to any point of the compass without finding a picture lying ready for treatment.
	
His family soon knew that he had the makings of an artist and, in 1620, when he could hardly have been more than sixteen, and may have been considerably less, he left Leyden University for the studio of a second-rate painter called Jan van Swanenburch. We have no authentic record of his progress in the studio, but it must have been rapid. He must have made friends, painted pictures, and attracted attention. At the end of three years he went to Lastmans studio in Amsterdam, returning thence to Leyden, where he took Gerard Dou as a pupil. A several years later, it is not easy to settle these dates on a satisfactory basis, he went to Amsterdam, and established himself there, because the Dutch capital was very wealthy and held many patrons of the arts, in spite of the seemingly endless war that Holland was waging with Spain.

His art remained true and sincere, he declined to make the smallest concession to what silly sitters called their taste, but he did not really know what to do with the money and commissions that flowed in upon him so freely. The best use he made of changing circumstances was to become engaged to Saskia van Uylenborch, the cousin of his great friend Hendrick van Uylenborch, the art dealer of Amsterdam. Saskia, who was destined to live for centuries, through the genius of her husband, seems to have been born in 1612, and to have become engaged to Rembrandt Van Ryn when she was twenty. The engagement followed very closely upon the patronage of Rembrandt Van Ryn by Prince Frederic Henry, the Stadtholder, who instructed the artist to paint three pictures.

<ol>
	<li>Saskia is enshrined in many pictures. </li>
	<li>She is seen first as a young girl, then as a woman. </li>
	<li>As a bride, in the picture now at Dresden, she sits upon her husbands knee, while he raises a big glass with his outstretched arm. </li>
	<li>Her expression here is rather shy, as if she deprecated the situation and realised that it might be misconstrued. </li>
	<li>This picture gave offence to Rembrandt Van Ryns critics, but some portraits of Saskia remained to be painted. </li>
	<li>She would seem to have aged rapidly, for after marriage her days were not long in the land. </li>
	<li>She was only thirty when she died, and looked much older.</li>
</ol>

In 1638 we find Rembrandt Van Ryn taking an action against one Albert van Loo, who had dared to call Saskia extravagant. It was, of course, still more extravagant of Rembrandt Van Ryn to waste his money on lawyers on account of a case he could not hope to win, but this thought does not seem to have troubled him. He did not reflect that it would set the gossips talking more cruelly than ever. Still full of enthusiasm for life and art, he was equally full of affection for Saskia, whose hope of raising children seemed doomed to disappointment, for in addition to losing the little Rombertus, two daughters, each named Cornelia, had died soon after birth. In 1640 Rembrandt Van Ryns mother died. Her picture remains on record with that of her husband, painted ten years before, and even the biographers of the artist do not suggest that Rembrandt Van Ryn was anything but a good son. A year later the well-beloved Saskia gave birth to the one child who survived the early years, the boy Titus. Then her health failed, and in 1642 she died, after eight years of married life that would seem to have been happy. In this year Rembrandt Van Ryn painted the famous "Night Watch," a picture representing the company of Francis Banning Cocq, and incidentally a day scene in spite of its popular name. The work succeeded in arousing a storm of indignation, for every sitter wanted to have equal prominence in the canvas.

It may be said that after Saskias death, and the exhibition of this fine work, Rembrandt Van Ryns pleasant years came to an end. He was then somewhere between thirty-six and thirty-eight years old, he had made his mark, and enjoyed a very large measure of recognition, but henceforward, his career was destined to be a very troubled one, full of disappointment, pain, and care. Perhaps it would have been no bad thing for him if he could have gone with Saskia into the outer darkness. The world would have been poorer, but the man himself would have been spared many years that may be even the devoted labours of his studio could not redeem.

Between 1642, when Saskia died, and 1649, it is not easy to follow the progress of his life; we can only state with certainty that his difficulties increased almost as quickly as his work ripened. His connection with Hendrickje Stoffels would seem to have started about 1649, and this woman with whom he lived until her death some thirteen years later, has been abused by many biographers because she was the painters mistress.

He has left to the world some 500 or 600 pictures that are admitted to be genuine, together with the etchings and drawings to which reference has been made. He is to be seen in many galleries in the Old World and the New, for he painted his own portrait more than a score of times. So Rembrandt Van Ryn has been raised in our days to the pinnacle of fame which is his by right; the festival of his tercentenary was acknowledged by the whole civilised world as the natural utterance of joy and pride of our small country in being able to count among its children the great Rembrandt Van Ryn.
					
',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')
					);
////post end///
//====================================================================================//
////post start 9///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img9.jpg" ;
$post_meta = array(
				   
				   "templ_seo_page_title" =>'Offering Healthy and Amazing SPECIALS for Guests .',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'Offering Healthy and Amazing SPECIALS for Guests.',
					"post_content" =>	'GUESTS can now SAVE $1500 to $2200 all summer long during ANY WEEK when you bring a friend! Week of May 30 June 6, 2009 through week of August 29 September 5, 2009

Summer is a wonderful season at  Resort & Spa. Now all guests staying one week or longer (Saturday to Saturday) can bring a friend at 50% off. We have extended our limited time offer for you.

In no particular order of importance these were - sculptress Rebecca Warren who was the fancied hot favourite with many bookies, "billboard artist" Mark Titchner - and finally film maker Phil Collins...(No not him of Genesis fame!).

When the judges cast their votes however it was Tomma Abts who came out on top. She won twenty five thousand british pounds and of course the Turner Prize itself. I am sure the money will come in handy - however its the exposure that Tomma will get from winning thats the really important thing here.

What does Tomma Abts do? Well she actually paints abstract art; usually in oils or acrylics. - something of a novelty for the Turner Prize - some would say! Tomma Abts was originally selected for her solo art exhibitions at Kunsthalle Basel, Switzerland, and Greengrassi, London.

<ol>
	<li>Tomma Abts has been praised by no less than the Tate Gallery who describes her canvases as "intimate" and "compelling" . </li>
	<li>They also comment on Tommas "consistent" and even "rigorous" method of painting. </li>
	<li>In addition the Tate states that Tomma Abts "enriches the language of abstract art" .</li>
	<li>With such praise heaped upon her head its no surprise to me that she won the prize. </li>
	<li>However I actually feel that Tommas abstract artwork isnt "knock out" but it definitely is OK.</li>
</ol>

The images or paintings of Tomma Abts are created by the repetiton of various geometrical shapes on a base of rich colour. Personally - I dont think that Tommas approach to painting is particularly original. However I have to admit that while not being "knock out" I find some of Tommas images pretty compelling and touching. I have to say that this does surprise me.

48 x 38 cms - exactly. These are the dimensions of every Tomma Abts painting. Im not sure quite why Tomma selected these dimensions. Obviously she finds them appealing and I suppose they make for a very compact painting.

When creating titles for her paintings apparently Tomma simply plucks one from a dictionary of German first names! Titles like "Veeke" for example were created in this way. In my view this is surely only slightly more interesting than numbering each picture!

All in all I think that Tomma Abts creates abstract art that is pretty accessible to the public at large. This is something that perhaps could not be said about the artwork of previous Turner Prize winners! I base my opinion of course on Tommas prize winning paintings. I would go further and state that I cannot conceive of a Tomma Abts creation offending anyone - even slightly.

In the end its just my personal opinion but I do believe that its entirely posible that Tomma Abts will go on to become a household name - within her own lifetime...Of course she could also disappear without trace from the media - and our minds in the blink of an eye, for precisely the same reasons.				
',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')
					);
////post end///
//====================================================================================//
////post start 10///
$image_array = array();
$post_meta = array();
$image_array[] = "dummy/img10.jpg" ;
$post_meta = array(
				   "templ_seo_page_title" =>'The Sixth Sense Spas ',
				   "templ_seo_page_kw" => '',
"tl_dummy_content"	=> '1',
				   "templ_seo_page_desc" => '',
				);
$post_info[] = array(
					"post_title" =>	'The Sixth Sense Spas',
					"post_content" =>	'PAs will receive a complimentary treatment from award-winning Six Senses Spas when booking a private jet charter through Chapman Freeborn, the World largest aircraft charter broker. Once Chapman Freeborn charter experts have arranged the boss executive flight itinerary, PAs will be invited to choose from a wide range of complimentary treatments and Asian-influenced therapies at one of Six Senses Spas. 
					
The treatments will be redeemable at locations across Europe, the Middle East and Asia as well as the luxury spa at Pan Peninsula in Canary Wharf, regarded by many PAs working in the city as an urban sanctuary.

Chinese art, and in particular, Chinese painting is greatly treasured around the globe. Chinese painting can be retraced to as far back as six thousand years ago in the Neolithic Age when the Chinese have started using brushes in their paintings. Chinese art dates back even sooner than that.

<h3>Calligraphic scripts</h3>
<ol>
	<li>The Kufic script is the first of those calligraphic scripts to gain popularit. </li>
	<li>It was angular, made of square and short horizontal strokes, long verticals, and bold, compact circles. </li>
	<li>For three centuries, this script had been mainly used to copy the Quran. </li>
	<li>The cursive Naskh script was more often used for casual writing. </li>
	<li>This script had rounder letters and thin lines. </li>
	<li>It would come to be preferred to Kufic for copying the Quran as techniques for writing in this style were refined. </li>
	<li>Almost all printed material in Arabic is in Naskh. </li>
	<li>The Thuluth would take on the ornamental role formerly associated with the Kufic script in the 13th century. </li>
	<li>Thuluth is usually written in ample curves as it has a strong cursive aspect. </li>
	<li>The Persians took to using Arabic script for their own language, Persian after their conversion to Islam. </li>
	<li>The Taliq and Nastaliq styles were contributed to Arabic calligraphy by the Persians. </li>
	<li>Nastaliq style is extremely cursive, with exaggeratedly long horizontal strokes. </li>
	<li>The Diwani script is a cursive style of Arabic calligraphy. </li>
	<li>It was developed during the reign of the early Ottoman Turks (16th and early 17th centuries). </li>
	<li>This outstanding Diwani script was both decorative and communicative. </li>
	<li>Finally, Riqa is the most commonly used script for everyday use. </li>
	<li>It is simple and easy to write. </li>
	<li>Its movements are small.</li>
	<li>In China, a calligraphic form called Sini has been developed. </li>
	<li>This form has evident influences from Chinese calligraphy. </li>
	<li>Hajji Noor Deen Mi Guangjiang is a famous modern calligrapher in this tradition.</li>
</ol>
 
 <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.</p>
    <h2>H2 level heading </h2>
    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio.</p>
',
					"post_meta" =>	$post_meta,
					"post_image" =>	$image_array,
					"post_category" =>	array('Blog'),
					"post_tags" =>	array('Tags','Sample Tags')

					);
////post end///
//====================================================================================//
insert_posts($post_info);
function insert_posts($post_info)
{
	global $wpdb,$current_user;
	for($i=0;$i<count($post_info);$i++)
	{
		$post_title = $post_info[$i]['post_title'];
		$post_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='post' and post_status in ('publish','draft')");
		if(!$post_count)
		{
			$post_info_arr = array();
			$catids_arr = array();
			$my_post = array();
			$post_info_arr = $post_info[$i];
			if($post_info_arr['post_category'])
			{
				for($c=0;$c<count($post_info_arr['post_category']);$c++)
				{
					$catids_arr[] = get_cat_ID($post_info_arr['post_category'][$c]);
				}
			}else
			{
				$catids_arr[] = 1;
			}
			$my_post['post_title'] = $post_info_arr['post_title'];
			$my_post['post_content'] = $post_info_arr['post_content'];
			if($post_info_arr['post_author'])
			{
				$my_post['post_author'] = $post_info_arr['post_author'];
			}else
			{
				$my_post['post_author'] = 1;
			}
			$my_post['post_status'] = 'publish';
			$my_post['post_category'] = $catids_arr;
			$my_post['tags_input'] = $post_info_arr['post_tags'];
			$last_postid = wp_insert_post( $my_post );
			$post_meta = $post_info_arr['post_meta'];
			if($post_meta)
			{
				foreach($post_meta as $mkey=>$mval)
				{
					update_post_meta($last_postid, $mkey, $mval);
				}
			}
			
			$post_image = $post_info_arr['post_image'];
			if($post_image)
			{
				for($m=0;$m<count($post_image);$m++)
				{
					$menu_order = $m+1;
					$image_name_arr = explode('/',$post_image[$m]);
					$img_name = $image_name_arr[count($image_name_arr)-1];
					$img_name_arr = explode('.',$img_name);
					$post_img = array();
					$post_img['post_title'] = $img_name_arr[0];
					$post_img['post_status'] = 'attachment';
					$post_img['post_parent'] = $last_postid;
					$post_img['post_type'] = 'attachment';
					$post_img['post_mime_type'] = 'image/jpeg';
					$post_img['menu_order'] = $menu_order;
					$last_postimage_id = wp_insert_post( $post_img );
					update_post_meta($last_postimage_id, '_wp_attached_file', $post_image[$m]);					
					$post_attach_arr = array(
										"width"	=>	580,
										"height" =>	480,
										"hwstring_small"=> "height='150' width='150'",
										"file"	=> $post_image[$m],
										//"sizes"=> $sizes_info_array,
										);
					wp_update_attachment_metadata( $last_postimage_id, $post_attach_arr );
				}
			}
		}
	}
}


insert_taxonomy_posts($post_info);
function insert_taxonomy_posts($post_info)
{
	global $wpdb,$current_user;
	for($i=0;$i<count($post_info);$i++)
	{
		$post_title = $post_info[$i]['post_title'];
		$post_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='".CUSTOM_POST_TYPE1."' and post_status in ('publish','draft')");
		if(!$post_count)
		{
			$post_info_arr = array();
			$catids_arr = array();
			$my_post = array();
			$post_info_arr = $post_info[$i];
			$my_post['post_title'] = $post_info_arr['post_title'];
			$my_post['post_content'] = $post_info_arr['post_content'];
			$my_post['post_type'] = CUSTOM_POST_TYPE1;
			if($post_info_arr['post_author'])
			{
				$my_post['post_author'] = $post_info_arr['post_author'];
			}else
			{
				$my_post['post_author'] = 1;
			}
			$my_post['post_status'] = 'publish';
			$my_post['post_category'] = $post_info_arr['post_category'];
			$my_post['tags_input'] = $post_info_arr['post_tags'];
			$last_postid = wp_insert_post( $my_post );
			wp_set_object_terms($last_postid,$post_info_arr['post_category'], $taxonomy=CUSTOM_CATEGORY_TYPE1);
			wp_set_object_terms($last_postid,$post_info_arr['post_tags'], $taxonomy='cartags');

			$post_meta = $post_info_arr['post_meta'];
			if($post_meta)
			{
				foreach($post_meta as $mkey=>$mval)
				{
					update_post_meta($last_postid, $mkey, $mval);
				}
			}
			
			$post_image = $post_info_arr['post_image'];
			if($post_image)
			{
				for($m=0;$m<count($post_image);$m++)
				{
					$menu_order = $m+1;
					$image_name_arr = explode('/',$post_image[$m]);
					$img_name = $image_name_arr[count($image_name_arr)-1];
					$img_name_arr = explode('.',$img_name);
					$post_img = array();
					$post_img['post_title'] = $img_name_arr[0];
					$post_img['post_status'] = 'attachment';
					$post_img['post_parent'] = $last_postid;
					$post_img['post_type'] = 'attachment';
					$post_img['post_mime_type'] = 'image/jpeg';
					$post_img['menu_order'] = $menu_order;
					$last_postimage_id = wp_insert_post( $post_img );
					update_post_meta($last_postimage_id, '_wp_attached_file', $post_image[$m]);					
					$post_attach_arr = array(
										"width"	=>	580,
										"height" =>	480,
										"hwstring_small"=> "height='150' width='150'",
										"file"	=> $post_image[$m],
										//"sizes"=> $sizes_info_array,
										);
					wp_update_attachment_metadata( $last_postimage_id, $post_attach_arr );
				}
			}
		}
	}
}
//====================================================================================//



insert_taxonomy_slider_posts($post_info);
function insert_taxonomy_slider_posts($post_info)
{
	global $wpdb,$current_user;
	for($i=0;$i<count($post_info);$i++)
	{
		$post_title = $post_info[$i]['post_title'];
		$post_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='".CUSTOM_POST_TYPE2."' and post_status in ('publish','draft')");
		if(!$post_count)
		{
			$post_info_arr = array();
			$catids_arr = array();
			$my_post = array();
			$post_info_arr = $post_info[$i];
			$my_post['post_title'] = $post_info_arr['post_title'];
			$my_post['post_content'] = $post_info_arr['post_content'];
			$my_post['post_type'] = CUSTOM_POST_TYPE2;
			if($post_info_arr['post_author'])
			{
				$my_post['post_author'] = $post_info_arr['post_author'];
			}else
			{
				$my_post['post_author'] = 1;
			}
			$my_post['post_status'] = 'publish';
			$my_post['post_category'] = $post_info_arr['post_category'];
			$my_post['tags_input'] = $post_info_arr['post_tags'];
			$last_postid = wp_insert_post( $my_post );
			wp_set_object_terms($last_postid,$post_info_arr['post_category'], $taxonomy=CUSTOM_CATEGORY_TYPE2);
			wp_set_object_terms($last_postid,$post_info_arr['post_tags'], $taxonomy='cartags');

			$post_meta = $post_info_arr['post_meta'];
			if($post_meta)
			{
				foreach($post_meta as $mkey=>$mval)
				{
					update_post_meta($last_postid, $mkey, $mval);
				}
			}
			
			$post_image = $post_info_arr['post_image'];
			if($post_image)
			{
				for($m=0;$m<count($post_image);$m++)
				{
					$menu_order = $m+1;
					$image_name_arr = explode('/',$post_image[$m]);
					$img_name = $image_name_arr[count($image_name_arr)-1];
					$img_name_arr = explode('.',$img_name);
					$post_img = array();
					$post_img['post_title'] = $img_name_arr[0];
					$post_img['post_status'] = 'attachment';
					$post_img['post_parent'] = $last_postid;
					$post_img['post_type'] = 'attachment';
					$post_img['post_mime_type'] = 'image/jpeg';
					$post_img['menu_order'] = $menu_order;
					$last_postimage_id = wp_insert_post( $post_img );
					update_post_meta($last_postimage_id, '_wp_attached_file', $post_image[$m]);					
					$post_attach_arr = array(
										"width"	=>	580,
										"height" =>	480,
										"hwstring_small"=> "height='150' width='150'",
										"file"	=> $post_image[$m],
										//"sizes"=> $sizes_info_array,
										);
					wp_update_attachment_metadata( $last_postimage_id, $post_attach_arr );
				}
			}
		}
	}
}
//====================================================================================//



/////////////////////////////////////////////////
$pages_array = array(array('Page Templates','Advanced Search','Archives','Full Width','Right Sidebar Page','Sitemap','Contact Us'),'Shortcodes',
array('Dropdowns','Sub Page 1','Sub Page 2'));
$page_info_arr = array();
$page_info_arr['Page Templates'] = '
In WordPress, you can write either posts or pages. When you writing a regular blog entry, you write a post. Posts automatically appear in reverse chronological order on your blog home page. Pages, on the other hand, are for content such as About Me, Contact Me, etc. Pages live outside of the normal blog chronology, and are often used to present information about yourself or your site that is somehow timeless information that is always applicable. You can use Pages to organize and manage any amount of content. WordPress can be configured to use different Page Templates for different Pages. 

To create a new Page, log in to your WordPress admin with sufficient admin privileges to create new page. Select the Pages &gt; Add New option to begin writing a new Page.


Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.

Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.

Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.

Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus.
';
$page_info_arr['Advanced Search'] = '
This is the Advanced Search page template. See how it looks. Just select this template from the page attributes section and you&rsquo;re good to go.
';
$page_info_arr['Archives'] = '
This is Archives page template. Just select it from page templates section and you&rsquo;re good to go.
';
$page_info_arr['Shortcodes'] = '
This theme comes with built in shortcodes. The shortcodes make it easy to add stylised content to your site, plus they&rsquo;re very easy to use. Below is a list of shortcodes which you will find in this theme.
[ Download ]
[Download] Download: Look, you can use me for highlighting some special parts in a post. I can make download links more highlighted. [/Download]
[ Alert ]
[Alert] Alert: Look, you can use me for highlighting some special parts in a post. I can be used to alert to some special points in a post. [/Alert]
[ Note ]
[Note] Note: Look, you can use me for highlighting some special parts in a post. I can be used to display a note and thereby bringing attention.[/Note]
[ Info ]
[Info] Info: Look, you can use me for highlighting some special parts in a post. I can be used to provide any extra information. [/Info]
[ Author Info ]
[Author Info]<img src="'.$dummy_image_path.'no-avatar.png" alt="" />
<h4>About The Author</h4>
Use me for adding more information about the author. You can use me anywhere within a post or a page, i am just awesome. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing.
[/Author Info]
<h3>Button List</h3>
[ Small_Button class="red" ]
[Small_Button class="red"]<a href="#">Button Text</a>[/Small_Button] [Small_Button class="grey"]<a href="#">Button Text</a>[/Small_Button] [Small_Button class="black"]<a href="#">Button Text</a>[/Small_Button] [Small_Button class="blue"]<a href="#">Button Text</a>[/Small_Button] [Small_Button class="lightblue"]<a href="#">Button Text</a>[/Small_Button] [Small_Button class="purple"]<a href="#">Button Text</a>[/Small_Button] [Small_Button class="magenta"]<a href="#">Button Text</a>[/Small_Button] [Small_Button class="green"]<a href="#">Button Text</a>[/Small_Button]  [Small_Button class="orange"]<a href="#">Button Text</a>[/Small_Button] [Small_Button class="yellow"]<a href="#">Button Text</a>[/Small_Button] [Small_Button class="pink"]<a href="#">Button Text</a>[/Small_Button]
<hr />
<h3>Icon list view</h3>
[ Icon List ]
[Icon List]
<ul>
	<li> Use the shortcode to add this attractive unordered list</li>
	<li> SEO options in every page and post</li>
	<li> 5 detailed color schemes</li>
	<li> Fully customizable front page</li>
	<li> Excellent Support</li>
	<li> Theme Guide &amp; Tutorials</li>
	<li> PSD File Included with multiple use license</li>
	<li> Gravatar Support &amp; Threaded Comments</li>
	<li> Inbuilt custom widgets</li>
	<li> 30 built in shortcodes</li>
	<li> 8 Page templates</li>
	<li>Valid, Cross browser compatible</li>
</ul>
[/Icon List]
<h3>Dropcaps Content</h3>
[ Dropcaps ] 
[Dropcaps] Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy.[/Dropcaps]

[Dropcaps] Dropcaps can be so useful sometimes. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy.[/Dropcaps]

<h3>Content boxes</h3>
We, the content boxes can be used to highlight special parts in the post. We can be used anywhere, just use the particular shortcode and we will be there.
[ Normal_Box ]
[Normal_Box]
<h3>Normal Box</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy.

[/Normal_Box]

[ Warning_Box ]
[Warning_Box]
<h3>Warring Box</h3>
This is how a warning content box will look like. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy.

[/Warning_Box]

[ Download_Box ]
[Download_Box]
<h3>Download Box</h3>
This is how a download content box will look like. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy.

[/Download_Box]

[ About_Box ]
[About_Box]
<h3>About Box</h3>
This is how about content box will look like. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus.

[/About_Box]

[ Info_Box ]

[Info_Box]
<h3>Info Box</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy.

[/Info_Box]

[ Alert_Box ]
[Alert_Box]
<h3>Alert Box</h3>
This is how alert content box will look like. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy.

[/Alert_Box]

[Info_Box_Equal]
<h3>Info Box</h3>
This is how info content box will look like. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna porttitor, felis. Use this shortcode for this type of Info box.<strong> [ Info_Box_Equal ]</strong>
[/Info_Box_Equal]


[Alert_Box_Equal]

<h3>Alert Box</h3>
This is how alert content box will look like. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna porttitor, felis. Use this shortcode for this type of alert box.<strong> [ Alert_Box_Equal ]</strong>


[/Alert_Box_Equal]

[About_Box_Equal]

<h3>About Box</h3>
This is how about content box will look like. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, molestie in, commodo  porttitor. Use this shortcode for this type of about box. <strong>[ About_Box_Equal ]</strong>

[/About_Box_Equal]


[One_Half]
<h3>One Half Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, felis. Nam blandit quam ut lacus. <strong>[ One_Half ]</strong>

[/One_Half]


[One_Half_Last]
<h3>One Half Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, felis. Nam blandit quam ut lacus. <strong>[ One_Half_Last ]</strong>

[/One_Half_Last]



[One_Third]
<h3>One Third Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam ut lacus. <strong>[ One_Third ]</strong>

[/One_Third]


[One_Third]
<h3>One Third Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in. Commodo  porttitor, felis. Nam lacus. <strong> [ One_Third ]</strong>

[/One_Third]



[One_Third_Last]
<h3>One Third Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, felis. <strong>[ One_Third_Last ]</strong>

[/One_Third_Last]



[One_Fourth]
<h3>One Fourth Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in to the.<strong>[ One_Fourth ]</strong>

[/One_Fourth]



[One_Fourth]
<h3>One Fourth Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in to the.<strong> [ One_Fourth ]</strong>

[/One_Fourth]


[One_Fourth]
<h3>One Fourth Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in to the.<strong>[ One_Fourth ]</strong>

[/One_Fourth]



[One_Fourth_Last]
<h3>One Fourth Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in to the.<strong>[ One_Fourth_Last ]</strong>

[/One_Fourth_Last]



[One_Third]
<h3>One Third Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus. <strong>[ One_Third ]</strong>

[/One_Third]



[Two_Third_Last]
<h3>Two Third Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. in, commodo  porttitor, felis. Nam blandit quam ut lacus.in, commodo  porttitor, felis. Nam blandit quam ut lacus.  <strong> [ Two_Third_Last ]</strong>

[/Two_Third_Last]



[Two_Third]
<h3>Two Third Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. in, commodo  porttitor, felis. Nam blandit quam ut lacus.in, commodo  porttitor, felis. Nam blandit quam ut lacus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. <strong>[ Two_Third ]</strong>

[/Two_Third]



[One_Third_Last]
<h3>One Third Column</h3>
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, commodo  porttitor, felis.  <strong> [ One_Third_Last ]</strong>

[/One_Third_Last]
';
$page_info_arr['Full Width'] = '
Do you know how easy it is to use Full Width page template ? Just add a new page and select full width page template and you are good to go. Here is a preview of this easy to use page template.

Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus.

Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.

Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.

Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.

Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.

See, there no sidebar in this template, and that why we call this a full page template. Yes, its this easy to use page templates. Just write any content as per your wish.
';
$page_info_arr['Right Sidebar Page'] = '
This is <strong>right sidebar page template</strong>. To use this page template, just select - page right sidebar template from Pages and publish the post. Its so easy using a page template.

Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id, libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut, sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. Donec nec libero.

Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id, libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut, sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh. Donec nec libero.

Praesent aliquam, justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id, libero. In eget purus.

Vestibulum ut nisl. Donec eu mi sed turpis feugiat feugiat. Integer  turpis arcu, pellentesque eget, cursus et, fermentum ut, sapien. Fusce  metus mi, eleifend sollicitudin, molestie id, varius et, nibh. Donec nec  libero. Nam blandit quam ut lacus. Quisque ornare risus quis ligula. Phasellus  tristique purus a augue condimentum adipiscing. Aenean sagittis. Etiam  leo pede, rhoncus venenatis, tristique in, vulputate at, odio. Donec et  ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce varius urna  id quam.
<blockquote>Blockquote text looks like this</blockquote>
See, using right sidebar page template is so easy. Really.
';
$page_info_arr['Sitemap'] = '
See, how easy is to use page templates. Just add a new page and select <strong>Sitemap</strong> from the page templates section. Easy peasy, isn&rsquo;t it.
';
$page_info_arr['Contact Us'] = '
What do you think about this Contact page template ? Have anything to say, any suggestions or any queries ? Feel free to contact us, we&rsquo;re here to help you. You can write any text in this page and use the Contact Us page template. Its very easy to use page templates.
';
$page_info_arr['Dropdowns'] = '
<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.</p>
<p>Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.</p>
<p>Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.</p>
';
$page_info_arr['Sub Page 1'] = '
<pLorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero. </p>

<P>Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero. </p>

<p>Justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero.</p>

<p>Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero. </p>
';
$page_info_arr['Sub Page 2'] = '
<pLorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero. </p>

<P>Praesent aliquam,  justo convallis luctus rutrum, erat nulla fermentum diam, at nonummy quam  ante ac quam. Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero. </p>

<p>Maecenas urna purus, fermentum id, molestie in, commodo  porttitor, felis. Nam blandit quam ut lacus. Quisque ornare risus quis  ligula. Phasellus tristique purus a augue condimentum adipiscing. Aenean  sagittis. Etiam leo pede, rhoncus venenatis, tristique in, vulputate at,  odio. Donec et ipsum et sapien vehicula nonummy. Suspendisse potenti. Fusce  varius urna id quam. Sed neque mi, varius eget, tincidunt nec, suscipit id,  libero. In eget purus. Vestibulum ut nisl. Donec eu mi sed turpis feugiat  feugiat. Integer turpis arcu, pellentesque eget, cursus et, fermentum ut,  sapien. Fusce metus mi, eleifend sollicitudin, molestie id, varius et, nibh.  Donec nec libero. </p>
';
set_page_info_autorun($pages_array,$page_info_arr);
function set_page_info_autorun($pages_array,$page_info_arr_arg)
{
	global $post_author,$wpdb;
	$last_tt_id = 1;
	if(count($pages_array)>0)
	{
		$page_info_arr = array();
		for($p=0;$p<count($pages_array);$p++)
		{
			if(is_array($pages_array[$p]))
			{
				for($i=0;$i<count($pages_array[$p]);$i++)
				{
					$page_info_arr1 = array();
					$page_info_arr1['post_title'] = $pages_array[$p][$i];
					$page_info_arr1['post_content'] = $page_info_arr_arg[$pages_array[$p][$i]];
					$page_info_arr1['post_parent'] = $pages_array[$p][0];
					$page_info_arr[] = $page_info_arr1;
				}
			}
			else
			{
				$page_info_arr1 = array();
				$page_info_arr1['post_title'] = $pages_array[$p];
				$page_info_arr1['post_content'] = $page_info_arr_arg[$pages_array[$p]];
				$page_info_arr1['post_parent'] = '';
				$page_info_arr[] = $page_info_arr1;
			}
		}

		if($page_info_arr)
		{
			for($j=0;$j<count($page_info_arr);$j++)
			{
				$post_title = $page_info_arr[$j]['post_title'];
				$post_content = addslashes($page_info_arr[$j]['post_content']);
				$post_parent = $page_info_arr[$j]['post_parent'];
				if($post_parent!='')
				{
					$post_parent_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like \"$post_parent\" and post_type='page'");
				}else
				{
					$post_parent_id = 0;
				}
				$post_date = date('Y-m-d H:s:i');
				$post_name = strtolower(str_replace(array("'",'"',"?",".","!","@","#","$","%","^","&","*","(",")","-","+","+"," "),array('-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-','-'),$post_title));
				$post_name_count = $wpdb->get_var("SELECT count(ID) FROM $wpdb->posts where post_title like \"$post_title\" and post_type='page'");
				if($post_name_count>0)
				{
					echo '';
				}else
				{
					$post_sql = "insert into $wpdb->posts (post_author,post_date,post_date_gmt,post_title,post_content,post_name,post_parent,post_type) values (\"$post_author\", \"$post_date\", \"$post_date\",  \"$post_title\", \"$post_content\", \"$post_name\",\"$post_parent_id\",'page')";
					$wpdb->query($post_sql);
					$last_post_id = $wpdb->get_var("SELECT max(ID) FROM $wpdb->posts");
					$guid = get_option('siteurl')."/?p=$last_post_id";
					$guid_sql = "update $wpdb->posts set guid=\"$guid\" where ID=\"$last_post_id\"";
					$wpdb->query($guid_sql);
					$ter_relation_sql = "insert into $wpdb->term_relationships (object_id,term_taxonomy_id) values (\"$last_post_id\",\"$last_tt_id\")";
					$wpdb->query($ter_relation_sql);
					update_post_meta( $last_post_id, 'pt_dummy_content', 1 );
				}
			}
		}
	}
}
//=====================================================================
$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Advanced Search' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'tpl_advanced_search.php' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Web Hosting Plan' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'tpl_full_page.php' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Shortcodes' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'tpl_full_page.php' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Archives' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'tpl_archives.php' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Full Width' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'tpl_full_page.php' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Right Sidebar Page' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'tpl_right_sidebar_page.php' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Sitemap' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'tpl_sitemap.php' );

$photo_page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Contact Us' and post_type='page'");
update_post_meta( $photo_page_id, '_wp_page_template', 'tpl_contact.php' );

$wp_upload_dir = wp_upload_dir();
$basedir = $wp_upload_dir['basedir'];
$baseurl = $wp_upload_dir['baseurl'];
$folderpath = $basedir."/dummy/";
full_copy( TEMPLATEPATH."/images/dummy/", $folderpath );
function full_copy( $source, $target ) 
{
	$imagepatharr = explode('/',str_replace(TEMPLATEPATH,'',$target));
	for($i=0;$i<count($imagepatharr);$i++)
	{
	  if($imagepatharr[$i])
	  {
		  $year_path = ABSPATH.$imagepatharr[$i]."/";
		  if (!file_exists($year_path)){
			 @mkdir($year_path, 0777);
		  }     
		}
	}
	if ( is_dir( $source ) ) {
		@mkdir( $target );
		$d = dir( $source );
		while ( FALSE !== ( $entry = $d->read() ) ) {
			if ( $entry == '.' || $entry == '..' ) {
				continue;
			}
			$Entry = $source . '/' . $entry; 
			if ( is_dir( $Entry ) ) {
				full_copy( $Entry, $target . '/' . $entry );
				continue;
			}
			@copy( $Entry, $target . '/' . $entry );
		}
	
		$d->close();
	}else {
		@copy( $source, $target );
	}
}


///////////////////////////////////////////////////////////////////////////////////
//====================================================================================//

/*echo "<pre>";
//print_r(get_option('sidebars_widgets'));
print_r(get_option('widget_home_slider'));
exit; */


/////////////// WIDGET SETTINGS START ///////////////

$sidebars_widgets = get_option('sidebars_widgets');  //collect widget informations
$sidebars_widgets = array();



////////////////header right side//////////////////////
$widget_templ_social = array();
$widget_templ_social[1] = array(
					"title"				=>	'For Reservation',
					"phone"			    =>	'0444 555 8888',	
					);						
$widget_templ_social['_multiwidget'] = '1';
update_option('widget_widget_templ_social',$widget_templ_social);
$widget_templ_social = get_option('widget_widget_templ_social');
krsort($widget_templ_social);
foreach($widget_templ_social as $key1=>$val1)
{
	$widget_templ_social_key = $key1;
	if(is_int($widget_templ_social_key))
	{
		break;
	}
}
$sidebars_widgets["header_logo_right_side"] = array("widget_templ_social-$widget_templ_social_key");


////////////////home_slider//////////////////////
$home_slider = array();
$home_slider[1] = array(
					"f1"				=>	'Grand lifestyle',
					"f1_url"			=>	'#',
					"f1_line"			=>	'awaits you',
					"f1_img"			=>	$dummy_image_path.'slide2.jpg',
					"f2"				=>	'Experience the breeze',
					"f2_url"			=>	'#',
					"f2_line"	        =>	'at exotic beaches',
					"f2_img"	        =>	$dummy_image_path.'slide1.jpg',
					"f3"				=>	'Cruise through the ocean',
					"f3_url"			=>	'#',
					"f3_line"			=>	'and get rejuvenated',
					"f3_img"			=>	$dummy_image_path.'slide3.jpg',
					"f4"				=>	'Refresh yourself',
					"f4_url"			=>	'#',
					"f4_line"			=>	'the exotic way!',
					"f4_img"			=>	$dummy_image_path.'slide4.jpg',
					"f5"				=>	'Delicious cuisines',
					"f5_url"			=>	'#',
					"f5_line"			=>	'from all over the world',
					"f5_img"			=>	$dummy_image_path.'slide5.jpg',
					"speed"				=>	'',
					);						
$home_slider['_multiwidget'] = '1';
update_option('widget_home_slider',$home_slider);
$home_slider = get_option('widget_home_slider');
krsort($home_slider);
foreach($home_slider as $key1=>$val1)
{
	$home_slider_key = $key1;
	if(is_int($home_slider_key))
	{
		break;
	}
}
$sidebars_widgets["home_slider"] = array("home_slider-$home_slider_key");


//////////////// Home Page Content ////////////////////// 

$widget_templ_bookan_appointment = array();
$widget_templ_bookan_appointment[1] = array(
					"title"		  =>	'Booking Online',					
					"desc"		  =>	'',		
					);						
$widget_templ_bookan_appointment['_multiwidget'] = '1';
update_option('widget_widget_templ_bookan_appointment',$widget_templ_bookan_appointment);
$widget_templ_bookan_appointment = get_option('widget_widget_templ_bookan_appointment');
krsort($widget_templ_bookan_appointment);
foreach($widget_templ_bookan_appointment as $key1=>$val1)
{
	$widget_templ_bookan_appointment_key = $key1;
	if(is_int($widget_templ_bookan_appointment_key))
	{
		break;
	}
}

$sidebars_widgets["index_page_content_left"] = array("widget_templ_bookan_appointment-$widget_templ_bookan_appointment_key");


////////////////footer3////////////////////// 
$latest_posts_with_date = array();
$latest_posts_with_date[1] = array(
					"title"			=>	'Latest News',					
					"category"		=>	'3',					
					"number"		=>	'2',					
					"post_type"		=>	'',					
					"more"			=>	'',															
					);				
$latest_posts_with_date['_multiwidget'] = '1';
update_option('widget_latest_posts_with_date',$latest_posts_with_date);
$latest_posts_with_date = get_option('widget_latest_posts_with_date');
krsort($latest_posts_with_date);
foreach($latest_posts_with_date as $key1=>$val1)
{
	$latest_posts_with_date_key = $key1;
	if(is_int($latest_posts_with_date_key))
	{
		break;
	}
}


$sidebars_widgets["footer3"] = array("latest_posts_with_date-$latest_posts_with_date_key");


////////////////footer1////////////////////// 
$text = array();
$text[1] = array(
					"title"		  =>	'Special Offers',					
					"text"		  =>	'<img src="'.$dummy_image_path.'special.png" alt="" /> Super Discount offers for everyone. <strong>25% Discount.</strong> Come, visit our Hotel at a special discounted rate.',
					);		
					
$text['_multiwidget'] = '1';
update_option('widget_text',$text);
$text = get_option('widget_text');
krsort($text);
foreach($text as $key1=>$val1)
{
	$text_key = $key1;
	if(is_int($text_key))
	{
		break;
	}
}

$sidebars_widgets["footer1"] = array("text-$text_key");


////////////////footer2////////////////////// 

$testimonials_widget = array();
$testimonials_widget[1] = array(
					"title"				=>	'Testimonials',					
					"fadin"				=>	'',					
					"fadout"			=>	'',					
					"author1"			=>	'Mark Anthony',					
					"quotetext1"		=>	'Your hotel is one of the best I have ever visited! Thanks for making my stay super awesome. I would surely recommend you Guys.',					
					"author2"			=>	'Marry Ribben',					
					"quotetext2"		=>	'My stay was delightful and very relaxing and staff were very welcoming. Thanks for everything.',					
					"author3"			=>	'Emma',	
					"quotetext3"		=>	'Very nice hotel and very pleasant stay. I will surely visit you again.',	
					"author4"			=>	'John',	
					"quotetext4"		=>	'This is a testimonial widget. In this widget you can write here testimonials.',
					"author5"			=>	'Raj',
					"quotetext5"		=>	'We were all very impressed and service was great and we will defiantly be coming back',
					);		
				
$testimonials_widget['_multiwidget'] = '1';
update_option('widget_testimonials_widget',$testimonials_widget);
$testimonials_widget = get_option('widget_testimonials_widget');
krsort($testimonials_widget);
foreach($testimonials_widget as $key1=>$val1)
{
	$testimonials_widget_key = $key1;
	if(is_int($testimonials_widget_key))
	{
		break;
	}
}

$sidebars_widgets["footer2"] = array("testimonials_widget-$testimonials_widget_key");


////////////////sidebar 1////////////////////// 


/*echo "<pre>";
//print_r(get_option('sidebars_widgets'));
print_r(get_option('widget_text'));
exit; */

$widget_templ_bookan_appointment2 = array();
$widget_templ_bookan_appointment2 = get_option('widget_widget_templ_bookan_appointment');
$widget_templ_bookan_appointment2[2] = array(
					"title"				=>	'Booking Online',					
					"desc"				=>	'Book Treatments, Services or Classes Instantly',	
					);		
				
$widget_templ_bookan_appointment2['_multiwidget'] = '1';
update_option('widget_widget_templ_bookan_appointment',$widget_templ_bookan_appointment2);
$widget_templ_bookan_appointment2 = get_option('widget_widget_templ_bookan_appointment');
krsort($widget_templ_bookan_appointment2);
foreach($widget_templ_bookan_appointment2 as $key1=>$val1)
{
	$widget_templ_bookan_appointment_key2 = $key1;
	if(is_int($widget_templ_bookan_appointment_key2))
	{
		break;
	}
}

$text2 = array();
$text2 = get_option('widget_text');
$text2[2] = array(
					"title"		  =>	'Special Offers',					
					"text"		  =>	'<img src="'.$dummy_image_path.'special2.png" alt=""  /> Super Discount offers for everyone. <strong>25% Discount.</strong> Come, visit our Hotel at a special discounted rate.',
					);				
$text2['_multiwidget'] = '1';
update_option('widget_text',$text2);
$text2 = get_option('widget_text');
krsort($text2);
foreach($text2 as $key1=>$val1)
{
	$text_key2 = $key1;
	if(is_int($text_key2))
	{
		break;
	}
}


$widget_location_map = array();
$widget_location_map[1] = array(
					"title"				=>	'Location',					
					"address"			=>	'230 Vine Street And locations throughout Old City, Philadelphia, PA 19106',					
					"address_latitude"	=>	'39.955823048131286',					
					"address_longitude"	=>	'-75.14408111572266',					
					"map_width"			=>	'240',					
					"map_height"		=>	'160',					
					"map_type"			=>	'ROADMAP',					
					"scale"				=>	'5',	
					);		
				
$widget_location_map['_multiwidget'] = '1';
update_option('widget_widget_location_map',$widget_location_map);
$widget_location_map = get_option('widget_widget_location_map');
krsort($widget_location_map);
foreach($widget_location_map as $key1=>$val1)
{
	$widget_location_map_key = $key1;
	if(is_int($widget_location_map_key))
	{
		break;
	}
}

$text3 = array();
$text3 = get_option('widget_text');
$text3[3] = array(
					"title"		  =>	'',					
					"text"		  =>	'<p><strong>Royal Hotel</strong></p>

<p>22 Floral Street, Covent Garden, <br /> Philadelphia PA 19106. <br />
Phone : 0844 575 8888<br />
FAX : 0845 575 7878 <br />
Email : info@spasalon.com </p> ',
					);				
$text3['_multiwidget'] = '1';
update_option('widget_text',$text3);
$text3 = get_option('widget_text');
krsort($text3);
foreach($text3 as $key1=>$val1)
{
	$text_key3 = $key1;
	if(is_int($text_key3))
	{
		break;
	}
}


$sidebars_widgets["sidebar1"] = array("widget_templ_bookan_appointment-$widget_templ_bookan_appointment_key2","text-$text_key2","widget_location_map-$widget_location_map_key","text-$text_key3");

//===============================================================================
//////////////////////////////////////////////////////
update_option('sidebars_widgets',$sidebars_widgets);  //save widget iformations
/////////////// WIDGET SETTINGS END /////////////

//=====================================================================
/////////////// Design Settings START ///////////////


// General settings start  /////
update_option("ptthemes_alt_stylesheet",'1-default');
update_option("ptthemes_show_blog_title",'No');
update_option("ptthemes_feedburner_url",'http://feeds2.feedburner.com/templatic');
update_option("ptthemes_feedburner_id",'templatic/ekPs');
update_option("ptthemes_tweet_button",'Yes');
update_option("ptthemes_facebook_button",'Yes');
update_option("ptthemes_date_format",'M j, Y');
update_option("pttheme_contact_email",'info@mysite.com');
update_option("ptthemes_breadcrumbs",'Yes');
update_option("ptthemes_auto_install",'No');
update_option("ptthemes_postcontent_full",'Excerpt');
update_option("ptthemes_content_excerpt_count",'40');
update_option("ptthemes_content_excerpt_readmore",'Read More &rarr;');
// General settings End  /////

// Navigation settings
update_option("ptthemes_main_pages_nav_enable",'Activate');
// Navigation settings

// Seo option
update_option("pttheme_seo_hide_fields",'No');
update_option("ptthemes_use_third_party_data",'No');
// Seo option 

// Post  option
update_option("ptthemes_home_page",'6');
update_option("ptthemes_cat_page",'6');
update_option("ptthemes_search_page",'6');
update_option("ptthemes_pagination",'Default + WP Page-Navi support');
// Post  option 

//Navigation  
$page_id1 = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'About' and post_type='page'");
$page_id2 = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Contcat Us' and post_type='page'");
$page_id3 = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Sub Page 1' and post_type='page'");
$page_id4 = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Sub Page 2' and post_type='page'");

$page_id5 = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Archives' and post_type='page'");
$page_id6 = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Gallery' and post_type='page'");
$page_id7 = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Site Map' and post_type='page'");
$page_id8 = $wpdb->get_var("SELECT ID FROM $wpdb->posts where post_title like 'Page Left Sidebar' and post_type='page'");

$pages_ids = $page_id1.",".$page_id2.",".$page_id3.",".$page_id4.",".$page_id5.",".$page_id6.",".$page_id7.",".$page_id8;
update_option("ptthemes_top_pages_nav",$pages_ids);
//Navigation  

// Page Layout
update_option("ptthemes_page_layout",'Page 2 column - Left Sidebar');
update_option("ptthemes_bottom_options",'Three Column');
// Page Layout

if($_REQUEST['dump']==1){
echo "<script>";
echo "window.location.href='".get_option('siteurl')."/wp-admin/themes.php?dummy_insert=1'";
echo "</script>";
}
/////////////// Design Settings END ///////////////
//====================================================================================//
?>