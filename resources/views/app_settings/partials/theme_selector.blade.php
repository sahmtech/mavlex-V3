    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('predefined_theme', __('settings.predefined_theme_label')) !!}
            @show_tooltip(__('settings.predefined_theme_tooltip'))
            <select class="form-control" id="predefined_theme" name="predefined_theme">
                <option value="">{{ __('settings.select_theme') }}</option>
                <option value="default">{{ __('settings.theme_default') }}</option>
                <option value="ocean_blue">Ocean Blue</option>
                <option value="forest_green">Forest Green</option>
                <option value="sunset_orange">Sunset Orange</option>
                <option value="royal_purple">Royal Purple</option>
                <option value="crimson_red">Crimson Red</option>
                <option value="midnight_dark">Midnight Dark</option>
                <option value="rose_gold">Rose Gold</option>
                <option value="mint_fresh">Mint Fresh</option>
                <option value="corporate_blue">Corporate Blue</option>
                <option value="emerald_luxury">Emerald Luxury</option>
                <option value="cherry_blossom">Cherry Blossom</option>
                <option value="arctic_frost">Arctic Frost</option>
                <option value="golden_sand">Golden Sand</option>
                <option value="lavender_dream">Lavender Dream</option>
                <option value="steel_gray">Steel Gray</option>
                <option value="tropical_paradise">Tropical Paradise</option>
                <option value="autumn_leaves">Autumn Leaves</option>
                <option value="deep_ocean">Deep Ocean</option>
                <option value="vintage_brown">Vintage Brown</option>
                <option value="electric_blue">Electric Blue</option>
                <option value="coral_reef">Coral Reef</option>
                <option value="moonlight_silver">Moonlight Silver</option>
                <option value="jade_green">Jade Green</option>
                <option value="wine_red">Wine Red</option>
                <option value="sky_blue">Sky Blue</option>
                <option value="copper_bronze">Copper Bronze</option>
                <option value="lime_green">Lime Green</option>
                <option value="plum_purple">Plum Purple</option>
                <option value="charcoal_black">Charcoal Black</option>
                <option value="peach_cream">Peach Cream</option>
                <option value="navy_gold">Navy Gold</option>
                <option value="burgundy_wine">Burgundy Wine</option>
                <option value="teal_turquoise">Teal Turquoise</option>
                <option value="pink_blush">Pink Blush</option>
                <option value="sage_green">Sage Green</option>
                <option value="amber_gold">Amber Gold</option>
                <option value="indigo_night">Indigo Night</option>
                <option value="rust_orange">Rust Orange</option>
                <option value="glacier_blue">Glacier Blue</option>
                <option value="mahogany_wood">Mahogany Wood</option>
                <option value="violet_storm">Violet Storm</option>
                <option value="olive_branch">Olive Branch</option>
                <option value="sunset_pink">Sunset Pink</option>
                <option value="forest_night">Forest Night</option>
                <option value="golden_hour">Golden Hour</option>
                <option value="sea_foam">Sea Foam</option>
                <option value="royal_blue">Royal Blue</option>
                <option value="desert_sand">Desert Sand</option>
                <option value="mystic_purple">Mystic Purple</option>
                <option value="earth_tone">Earth Tone</option>
                <option value="blush_petal">Blush Petal</option>
                <option value="cocoa_mocha">Cocoa Mocha</option>
                <option value="icy_mint">Icy Mint</option>
                <option value="lemon_drop">Lemon Drop</option>
                <option value="coral_sunset">Coral Sunset</option>
                <option value="denim_dusk">Denim Dusk</option>
                <option value="orchid_bloom">Orchid Bloom</option>
                <option value="sapphire_wave">Sapphire Wave</option>
                <option value="amber_honey">Amber Honey</option>
                <option value="moss_garden">Moss Garden</option>
                <option value="flamingo_fizz">Flamingo Fizz</option>
                <option value="graphite_slate">Graphite Slate</option>
                <option value="lavender_mist">Lavender Mist</option>
                <option value="ruby_garnet">Ruby Garnet</option>
                <option value="pearl_shell">Pearl Shell</option>
                <option value="steel_teal">Steel Teal</option>
                <option value="apricot_glow">Apricot Glow</option>
                <option value="cactus_green">Cactus Green</option>
                <option value="night_fall">Night Fall</option>
                <option value="sky_morning">Sky Morning</option>
                <option value="rosewood">Rosewood</option>
                <option value="glacier_frost">Glacier Frost</option>
                <option value="sand_dune">Sand Dune</option>
                <option value="lagoon_blue">Lagoon Blue</option>
                <option value="lilac_dream">Lilac Dream</option>
                <option value="crimson_tide">Crimson Tide</option>
                <option value="gold_leaf">Gold Leaf</option>
                <option value="azure_skies">Azure Skies</option>
                <option value="pumpkin_spice">Pumpkin Spice</option>
                <option value="mint_chocolate">Mint Chocolate</option>
                <option value="arctic_night">Arctic Night</option>
                <option value="pistachio_swirl">Pistachio Swirl</option>
                <option value="cherry_pop">Cherry Pop</option>
                <option value="dusky_pink">Dusky Pink</option>
                <option value="noir_eclipse">Noir Eclipse</option>
                <option value="banana_cream">Banana Cream</option>
                <option value="cinnamon_roll">Cinnamon Roll</option>
                <option value="arctic_ocean">Arctic Ocean</option>
                <option value="thunder_gray">Thunder Gray</option>
                <option value="sunset_glow">Sunset Glow</option>
                <option value="honey_mustard">Honey Mustard</option>
                <option value="basil_leaf">Basil Leaf</option>
                <option value="royal_maroon">Royal Maroon</option>
                <option value="powder_blue">Powder Blue</option>
                <option value="antique_gold">Antique Gold</option>
                <option value="bubblegum">Bubblegum</option>
                <option value="dusty_rose">Dusty Rose</option>
                <option value="carbon_black">Carbon Black</option>
                <option value="teal_wave">Teal Wave</option>
                <option value="frost_white">Frost White</option>
                <option value="sunrise_peach">Sunrise Peach</option>
                <option value="arctic_breeze">Arctic Breeze</option>
                <option value="cobalt_dream">Cobalt Dream</option>
                <option value="mulberry_milk">Mulberry Milk</option>
                <option value="pine_forest">Pine Forest</option>
                <option value="sandstone_blush">Sandstone Blush</option>
                <option value="oasis_green">Oasis Green</option>
                <option value="firebrick">Firebrick</option>
                <option value="periwinkle_bay">Periwinkle Bay</option>
                <option value="sunflower_field">Sunflower Field</option>
                <option value="ocean_mist">Ocean Mist</option>
                <option value="storm_cloud">Storm Cloud</option>
                <option value="marigold_sunset">Marigold Sunset</option>
                <option value="cranberry_crush">Cranberry Crush</option>
                <option value="buttercup">Buttercup</option>
                <option value="celestial_blue">Celestial Blue</option>
                <option value="marine_teal">Marine Teal</option>
                <option value="orchid_haze">Orchid Haze</option>
                <option value="copper_rust">Copper Rust</option>
                <option value="ginger_snap">Ginger Snap</option>
                <option value="indigo_wave">Indigo Wave</option>
                <option value="sage_mist">Sage Mist</option>
                <option value="tuscany_sunset">Tuscany Sunset</option>
                <option value="amaranth_pink">Amaranth Pink</option>
                <option value="ivory_cream">Ivory Cream</option>
                <option value="charcoal_navy">Charcoal Navy</option>
                <option value="peacock_feather">Peacock Feather</option>
                <option value="platinum_silver">Platinum Silver</option>
                <option value="bamboo_forest">Bamboo Forest</option>
                <option value="blizzard_blue">Blizzard Blue</option>
                <option value="lavender_field">Lavender Field</option>
                <option value="autumn_rust">Autumn Rust</option>
                <option value="petrol_blue">Petrol Blue</option>
                <option value="cocoa_butter">Cocoa Butter</option>
                <option value="red_velvet">Red Velvet</option>
                <option value="misty_rose">Misty Rose</option>
                <option value="silver_moon">Silver Moon</option>
                <option value="gold_rush">Gold Rush</option>
                <option value="olive_grove">Olive Grove</option>
                <option value="tropical_lime">Tropical Lime</option>
                <option value="dusty_lavender">Dusty Lavender</option>
                <option value="sandstone_beach">Sandstone Beach</option>
                <option value="azure_tide">Azure Tide</option>
                <option value="iced_latte">Iced Latte</option>
                <option value="peach_sorbet">Peach Sorbet</option>
                <option value="evergreen">Evergreen</option>
                <option value="sapphire_night">Sapphire Night</option>
                <option value="copper_glow">Copper Glow</option>
                <option value="violet_dream">Violet Dream</option>
                <option value="graphite_shadow">Graphite Shadow</option>
                <option value="moonstone_gray">Moonstone Gray</option>
                <option value="saffron_sunrise">Saffron Sunrise</option>
                <option value="aquamarine_dream">Aquamarine Dream</option>
                <option value="crimson_twilight">Crimson Twilight</option>
                <option value="juniper_fog">Juniper Fog</option>
                <option value="orchid_mist">Orchid Mist</option>
                <option value="bronze_glow">Bronze Glow</option>
                <option value="cerulean_sky">Cerulean Sky</option>
                <option value="emerald_deep">Emerald Deep</option>
                <option value="coral_burst">Coral Burst</option>
                <option value="midnight_velvet">Midnight Velvet</option>
                <option value="sunflower_field">Sunflower Field</option>
                <option value="sapphire_shimmer">Sapphire Shimmer</option>
                <option value="blush_pink">Blush Pink</option>
                <option value="pine_forest">Pine Forest</option>
                <option value="desert_mirage">Desert Mirage</option>
                <option value="amethyst_evening">Amethyst Evening</option>
                <option value="honey_gold">Honey Gold</option>
                <option value="glacial_blue">Glacial Blue</option>
                <option value="cinnamon_spice">Cinnamon Spice</option>
                <option value="tropical_turquoise">Tropical Turquoise</option>
                <option value="berry_sorbet">Berry Sorbet</option>
                <option value="steel_blue">Steel Blue</option>
                <option value="sunset_lavender">Sunset Lavender</option>
                <option value="mossy_terrain">Mossy Terrain</option>
                <option value="peacock_pride">Peacock Pride</option>
                <option value="mauve_mystery">Mauve Mystery</option>
                <option value="caramel_latte">Caramel Latte</option>
                <option value="arctic_aurora">Arctic Aurora</option>
                <option value="fiery_sunset">Fiery Sunset</option>
                <option value="deep_emerald">Deep Emerald</option>
                <option value="ocean_foam">Ocean Foam</option>
                <option value="royal_plum">Royal Plum</option>
                <option value="golden_wheat">Golden Wheat</option>
                <option value="silver_moon">Silver Moon</option>
                <option value="raspberry_riot">Raspberry Riot</option>
                <option value="teal_tide">Teal Tide</option>
                <option value="chocolate_cherry">Chocolate Cherry</option>
                <option value="skyline_blue">Skyline Blue</option>
                <option value="citrus_zest">Citrus Zest</option>
                <option value="violet_vogue">Violet Vogue</option>
                <option value="mint_mojito">Mint Mojito</option>
                <option value="copper_canyon">Copper Canyon</option>
                <option value="deep_space">Deep Space</option>
                <option value="buttercup_yellow">Buttercup Yellow</option>
                <option value="berry_wine">Berry Wine</option>
                <option value="seafoam_splash">Seafoam Splash</option>
                <option value="smoke_gray">Smoke Gray</option>
                <option value="coral_reef">Coral Reef</option>
                <option value="lavender_field">Lavender Field</option>
                <option value="pumpkin_spice">Pumpkin Spice</option>
                <option value="glacier_green">Glacier Green</option>
                <option value="merlot_magic">Merlot Magic</option>
                <option value="tangerine_tango">Tangerine Tango</option>
                <option value="oasis_blue">Oasis Blue</option>
                <option value="platinum_frost">Platinum Frost</option>
                <option value="ruby_red">Ruby Red</option>
                <option value="lime_sorbet">Lime Sorbet</option>
                <option value="dusk_purple">Dusk Purple</option>
                <option value="sand_dune">Sand Dune</option>
                <option value="lagoon_blue">Lagoon Blue</option>
                <option value="rose_quartz">Rose Quartz</option>
                <option value="bronzed_earth">Bronzed Earth</option>
                <option value="frosted_lilac">Frosted Lilac</option>
                <option value="sangria_night">Sangria Night</option>
                <option value="citrine_yellow">Citrine Yellow</option>
                <option value="deep_sea">Deep Sea</option>
                <option value="terra_cotta">Terra Cotta</option>
                <option value="arctic_white">Arctic White</option>
                <option value="magenta_mood">Magenta Mood</option>
                <option value="olive_garden">Olive Garden</option>
                <option value="blue_steel">Blue Steel</option>
                <option value="peach_parfait">Peach Parfait</option>
                <option value="twilight_blue">Twilight Blue</option>
                <option value="mocha_brown">Mocha Brown</option>
                <option value="jade_stone">Jade Stone</option>
                <option value="crimson_sun">Crimson Sun</option>
                <option value="mint_julep">Mint Julep</option>
                <option value="purple_rain">Purple Rain</option>
                <option value="golden_apricot">Golden Apricot</option>
                <option value="ocean_depth">Ocean Depth</option>
                <option value="cranberry_crush">Cranberry Crush</option>
                <option value="silver_sage">Silver Sage</option>
                <option value="amber_glow">Amber Glow</option>
                <option value="deep_lavender">Deep Lavender</option>
                <option value="desert_sun">Desert Sun</option>
                <option value="emerald_city">Emerald City</option>
                <option value="blush_beige">Blush Beige</option>
                <option value="navy_night">Navy Night</option>
                <option value="sunny_lemon">Sunny Lemon</option>
                <option value="plum_passion">Plum Passion</option>
                <option value="forest_fog">Forest Fog</option>
                <option value="cobalt_sea">Cobalt Sea</option>
                <option value="coral_charm">Coral Charm</option>
                <option value="champagne_gold">Champagne Gold</option>
                <option value="misty_rose">Misty Rose</option>
                <option value="pineapple_yellow">Pineapple Yellow</option>
                <option value="royal_amethyst">Royal Amethyst</option>
                <option value="coastal_breeze">Coastal Breeze</option>
                <option value="chocolate_truffle">Chocolate Truffle</option>
                <option value="frost_blue">Frost Blue</option>
                <option value="raspberry_rose">Raspberry Rose</option>
                <option value="olive_oil">Olive Oil</option>
                <option value="sky_azure">Sky Azure</option>
                <option value="pear_green">Pear Green</option>
                <option value="burgundy_velvet">Burgundy Velvet</option>
                <option value="sandy_beach">Sandy Beach</option>
                <option value="deep_purple">Deep Purple</option>
                <option value="goldenrod_field">Goldenrod Field</option>
                <option value="glacier_blue">Glacier Blue</option>
                <option value="mulberry_wine">Mulberry Wine</option>
                <option value="seaglass_green">Seaglass Green</option>
                <option value="sunset_gold">Sunset Gold</option>
                <option value="deep_teal">Deep Teal</option>
                <option value="blossom_pink">Blossom Pink</option>
                <option value="sandstone_canyon">Sandstone Canyon</option>
                <option value="royal_jade">Royal Jade</option>
                <option value="copper_penny">Copper Penny</option>
                <option value="midnight_iris">Midnight Iris</option>
                <option value="lemon_ice">Lemon Ice</option>
                <option value="berry_blast">Berry Blast</option>
                <option value="ocean_storm">Ocean Storm</option>
                <option value="camel_tan">Camel Tan</option>
                <option value="lilac_bloom">Lilac Bloom</option>
                <option value="sunburnt_orange">Sunburnt Orange</option>
                <option value="marine_blue">Marine Blue</option>
                <option value="honey_mustard">Honey Mustard</option>
                <option value="plum_perfect">Plum Perfect</option>
                <option value="aspen_gold">Aspen Gold</option>
                <option value="deep_rose">Deep Rose</option>
                <option value="aqua_marine">Aqua Marine</option>
                <option value="cocoa_brown">Cocoa Brown</option>
                <option value="frosted_mint">Frosted Mint</option>
                <option value="sunset_pink">Sunset Pink</option>
                <option value="pine_green">Pine Green</option>
                <option value="royal_indigo">Royal Indigo</option>
                <option value="butterscotch">Butterscotch</option>
                <option value="misty_morning">Misty Morning</option>
                <option value="blueberry_blue">Blueberry Blue</option>
                <option value="terracotta_red">Terracotta Red</option>
                <option value="seafarer_blue">Seafarer Blue</option>
                <option value="peach_bloom">Peach Bloom</option>
                <option value="dusky_lavender">Dusky Lavender</option>
                <option value="amber_autumn">Amber Autumn</option>
                <option value="deep_sky">Deep Sky</option>
                <option value="mossy_oak">Mossy Oak</option>
                <option value="rosewood_red">Rosewood Red</option>
                <option value="lagoon_reflection">Lagoon Reflection</option>
                <option value="sunny_yellow">Sunny Yellow</option>
                <option value="purple_haze">Purple Haze</option>
                <option value="desert_rose">Desert Rose</option>
                <option value="glacial_teal">Glacial Teal</option>
                <option value="crimson_clover">Crimson Clover</option>
                <option value="ocean_mist">Ocean Mist</option>
                <option value="bronze_olive">Bronze Olive</option>
                <option value="frosty_purple">Frosty Purple</option>
                <option value="sunny_orange">Sunny Orange</option>
                <option value="deep_forest">Deep Forest</option>
                <option value="pearl_white">Pearl White</option>
                <option value="royal_ruby">Royal Ruby</option>
                <option value="minty_fresh">Minty Fresh</option>
                <option value="copper_sunset">Copper Sunset</option>
                <option value="deep_water">Deep Water</option>
                <option value="autumn_red">Autumn Red</option>
                <option value="glacier_gray">Glacier Gray</option>
                <option value="berry_cheesecake">Berry Cheesecake</option>
                <option value="sandy_cove">Sandy Cove</option>
                <option value="twilight_purple">Twilight Purple</option>
                <option value="golden_sun">Golden Sun</option>
                <option value="marine_green">Marine Green</option>
                <option value="blush_wine">Blush Wine</option>
                <option value="mossy_rock">Mossy Rock</option>
                <option value="arctic_blue">Arctic Blue</option>
                <option value="spiced_orange">Spiced Orange</option>
                <option value="deep_plum">Deep Plum</option>
                <option value="ocean_blue">Ocean Blue</option>
                <option value="sunny_green">Sunny Green</option>
                <option value="royal_blue">Royal Blue</option>
                <option value="caramel_apple">Caramel Apple</option>
                <option value="frosted_teal">Frosted Teal</option>
                <option value="sunset_red">Sunset Red</option>
                <option value="deep_emerald">Deep Emerald</option>
                <option value="misty_blue">Misty Blue</option>
                <option value="copper_rose">Copper Rose</option>
                <option value="glacial_purple">Glacial Purple</option>
                <option value="berry_smoothie">Berry Smoothie</option>
                <option value="sandy_trail">Sandy Trail</option>
                <option value="twilight_teal">Twilight Teal</option>
                <option value="golden_glow">Golden Glow</option>
                <option value="marine_teal">Marine Teal</option>
                <option value="blush_coral">Blush Coral</option>
                <option value="mossy_green">Mossy Green</option>
                <option value="arctic_green">Arctic Green</option>
                <option value="spiced_wine">Spiced Wine</option>
                <option value="deep_cyan">Deep Cyan</option>
                <option value="oasis_green">Oasis Green</option>
                <option value="sunny_coral">Sunny Coral</option>
                <option value="royal_purple">Royal Purple</option>
                <option value="caramel_dream">Caramel Dream</option>
                <option value="frosted_rose">Frosted Rose</option>
                <option value="sunset_orange">Sunset Orange</option>
                <option value="deep_jade">Deep Jade</option>
                <option value="misty_lavender">Misty Lavender</option>
                <option value="copper_glow">Copper Glow</option>
                <option value="glacial_ice">Glacial Ice</option>
                <option value="berry_delight">Berry Delight</option>
                <option value="sandy_desert">Sandy Desert</option>
                <option value="twilight_blue">Twilight Blue</option>
                <option value="golden_hour">Golden Hour</option>
                <option value="marine_blue">Marine Blue</option>
                <option value="blush_pink">Blush Pink</option>
                <option value="mossy_mist">Mossy Mist</option>
                <option value="arctic_frost">Arctic Frost</option>
                <option value="spiced_cider">Spiced Cider</option>
                <option value="deep_violet">Deep Violet</option>
                <option value="ocean_green">Ocean Green</option>
                <option value="sunny_days">Sunny Days</option>
                <option value="royal_magenta">Royal Magenta</option>
                <option value="caramel_swirl">Caramel Swirl</option>
                <option value="frosted_berry">Frosted Berry</option>
            </select>
        </div>
    </div>
<script>
    var color_themes = {
    'default': { primary_color: '#FFB600', secondary_color: '#011530', body_color: '#F8F9FF', sidebar_text_color: '#FFFFFF'},
    'ocean_blue': { primary_color: '#0077BE', secondary_color: '#003D5B', body_color: '#E6F3FF', sidebar_text_color: '#FFFFFF'},
    'forest_green': { primary_color: '#228B22', secondary_color: '#006400', body_color: '#F0FFF0', sidebar_text_color: '#FFFFFF'},
    'sunset_orange': { primary_color: '#FF6B35', secondary_color: '#8B4513', body_color: '#FFF8DC', sidebar_text_color: '#FFFFFF'},
    'royal_purple': { primary_color: '#663399', secondary_color: '#2E0854', body_color: '#F8F4FF', sidebar_text_color: '#FFFFFF'},
    'crimson_red': { primary_color: '#DC143C', secondary_color: '#8B0000', body_color: '#FFF0F5', sidebar_text_color: '#FFFFFF'},
    'midnight_dark': { primary_color: '#4169E1', secondary_color: '#191970', body_color: '#2F2F2F', sidebar_text_color: '#E0E0E0'},
    'rose_gold': { primary_color: '#E8B4CB', secondary_color: '#B76E79', body_color: '#FDF2F8', sidebar_text_color: '#FFFFFF'},
    'mint_fresh': { primary_color: '#00CED1', secondary_color: '#008B8B', body_color: '#F0FFFF', sidebar_text_color: '#FFFFFF'},
    'corporate_blue': { primary_color: '#1E3A8A', secondary_color: '#1E40AF', body_color: '#F8FAFC', sidebar_text_color: '#FFFFFF'},
    'emerald_luxury': { primary_color: '#50C878', secondary_color: '#355E3B', body_color: '#F0FFF0', sidebar_text_color: '#FFFFFF'},
    'cherry_blossom': { primary_color: '#FFB7C5', secondary_color: '#8B4789', body_color: '#FFF0F5', sidebar_text_color: '#FFFFFF'},
    'arctic_frost': { primary_color: '#87CEEB', secondary_color: '#4682B4', body_color: '#F0F8FF', sidebar_text_color: '#FFFFFF'},
    'golden_sand': { primary_color: '#DAA520', secondary_color: '#8B6914', body_color: '#FFFAF0', sidebar_text_color: '#FFFFFF'},
    'lavender_dream': { primary_color: '#B19CD9', secondary_color: '#663399', body_color: '#F8F4FF', sidebar_text_color: '#FFFFFF'},
    'steel_gray': { primary_color: '#708090', secondary_color: '#2F4F4F', body_color: '#F8F8FF', sidebar_text_color: '#FFFFFF'},
    'tropical_paradise': { primary_color: '#FF7F50', secondary_color: '#CD853F', body_color: '#FFF8DC', sidebar_text_color: '#FFFFFF'},
    'autumn_leaves': { primary_color: '#D2691E', secondary_color: '#8B4513', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF'},
    'deep_ocean': { primary_color: '#000080', secondary_color: '#191970', body_color: '#E6E6FA', sidebar_text_color: '#FFFFFF'},
    'vintage_brown': { primary_color: '#8B4513', secondary_color: '#654321', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF'},
    'electric_blue': { primary_color: '#0080FF', secondary_color: '#003F7F', body_color: '#E6F3FF', sidebar_text_color: '#FFFFFF'},
    'coral_reef': { primary_color: '#FF7F50', secondary_color: '#FF6347', body_color: '#FFF8DC', sidebar_text_color: '#FFFFFF'},
    'moonlight_silver': { primary_color: '#C0C0C0', secondary_color: '#696969', body_color: '#F8F8FF', sidebar_text_color: '#FFFFFF'},
    'jade_green': { primary_color: '#00A86B', secondary_color: '#006B54', body_color: '#F0FFF0', sidebar_text_color: '#FFFFFF'},
    'wine_red': { primary_color: '#722F37', secondary_color: '#5C2223', body_color: '#FFF0F5', sidebar_text_color: '#FFFFFF'},
    'sky_blue': { primary_color: '#87CEEB', secondary_color: '#4682B4', body_color: '#F0F8FF', sidebar_text_color: '#FFFFFF'},
    'copper_bronze': { primary_color: '#CD7F32', secondary_color: '#8B4513', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF'},
    'lime_green': { primary_color: '#32CD32', secondary_color: '#228B22', body_color: '#F0FFF0', sidebar_text_color: '#FFFFFF'},
    'plum_purple': { primary_color: '#8E4585', secondary_color: '#663399', body_color: '#F8F4FF', sidebar_text_color: '#FFFFFF'},
    'charcoal_black': { primary_color: '#36454F', secondary_color: '#2F2F2F', body_color: '#1C1C1C', sidebar_text_color: '#E0E0E0'},
    'peach_cream': { primary_color: '#FFCBA4', secondary_color: '#CD853F', body_color: '#FFF8DC', sidebar_text_color: '#FFFFFF'},
    'navy_gold': { primary_color: '#FFD700', secondary_color: '#000080', body_color: '#F0F8FF', sidebar_text_color: '#FFFFFF'},
    'burgundy_wine': { primary_color: '#800020', secondary_color: '#4B0014', body_color: '#FFF0F5', sidebar_text_color: '#FFFFFF'},
    'teal_turquoise': { primary_color: '#008080', secondary_color: '#2F4F4F', body_color: '#E0FFFF', sidebar_text_color: '#FFFFFF'},
    'pink_blush': { primary_color: '#FF69B4', secondary_color: '#C71585', body_color: '#FFF0F5', sidebar_text_color: '#FFFFFF'},
    'sage_green': { primary_color: '#9CAF88', secondary_color: '#556B2F', body_color: '#F0FFF0', sidebar_text_color: '#FFFFFF'},
    'amber_gold': { primary_color: '#FFBF00', secondary_color: '#FF8C00', body_color: '#FFFAF0', sidebar_text_color: '#FFFFFF'},
    'indigo_night': { primary_color: '#4B0082', secondary_color: '#2E0054', body_color: '#E6E6FA', sidebar_text_color: '#FFFFFF'},
    'rust_orange': { primary_color: '#B7410E', secondary_color: '#8B2500', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF'},
    'glacier_blue': { primary_color: '#6CB4EE', secondary_color: '#4682B4', body_color: '#F0F8FF', sidebar_text_color: '#FFFFFF'},
    'mahogany_wood': { primary_color: '#C04000', secondary_color: '#8B2500', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF'},
    'violet_storm': { primary_color: '#8A2BE2', secondary_color: '#4B0082', body_color: '#E6E6FA', sidebar_text_color: '#FFFFFF'},
    'olive_branch': { primary_color: '#808000', secondary_color: '#556B2F', body_color: '#F0FFF0', sidebar_text_color: '#FFFFFF'},
    'sunset_pink': { primary_color: '#FF91A4', secondary_color: '#FF1493', body_color: '#FFF0F5', sidebar_text_color: '#FFFFFF'},
    'forest_night': { primary_color: '#355E3B', secondary_color: '#2F4F2F', body_color: '#1C2F1C', sidebar_text_color: '#E0E0E0'},
    'golden_hour': { primary_color: '#FFD700', secondary_color: '#DAA520', body_color: '#FFFAF0', sidebar_text_color: '#FFFFFF'},
    'sea_foam': { primary_color: '#71EEB8', secondary_color: '#2E8B57', body_color: '#F0FFF0', sidebar_text_color: '#FFFFFF'},
    'royal_blue': { primary_color: '#4169E1', secondary_color: '#191970', body_color: '#F0F8FF', sidebar_text_color: '#FFFFFF'},
    'desert_sand': { primary_color: '#EDC9AF', secondary_color: '#D2B48C', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF'},
    'mystic_purple': { primary_color: '#9966CC', secondary_color: '#663399', body_color: '#F8F4FF', sidebar_text_color: '#FFFFFF'},
    'earth_tone': { primary_color: '#8B7355', secondary_color: '#696969', body_color: '#F5F5DC', sidebar_text_color: '#FFFFFF'}, blush_petal:      { primary_color:"#F29CA3", secondary_color:"#B85C6B", body_color:"#FFF6F7", sidebar_text_color:"#FFFFFF" },
    cocoa_mocha:      { primary_color:"#704438", secondary_color:"#3F251C", body_color:"#FAF5F2", sidebar_text_color:"#FFFFFF" },
    icy_mint:         { primary_color:"#7EE0D1", secondary_color:"#118C7E", body_color:"#F1FFFD", sidebar_text_color:"#FFFFFF" },
    lemon_drop:       { primary_color:"#FFE450", secondary_color:"#C4A600", body_color:"#FFFDE6", sidebar_text_color:"#4A4A4A" },
    coral_sunset:     { primary_color:"#FF7167", secondary_color:"#BF3A30", body_color:"#FFF2F0", sidebar_text_color:"#FFFFFF" },
    denim_dusk:       { primary_color:"#4A6C94", secondary_color:"#273C59", body_color:"#F4F7FB", sidebar_text_color:"#FFFFFF" },
    orchid_bloom:     { primary_color:"#B388EB", secondary_color:"#6941C6", body_color:"#F8F4FF", sidebar_text_color:"#FFFFFF" },
    sapphire_wave:    { primary_color:"#2680C2", secondary_color:"#12507E", body_color:"#E8F4FF", sidebar_text_color:"#FFFFFF" },
    amber_honey:      { primary_color:"#FFB238", secondary_color:"#CC7F04", body_color:"#FFF6E6", sidebar_text_color:"#4A4A4A" },
    moss_garden:      { primary_color:"#6C9A3B", secondary_color:"#3C5A1D", body_color:"#F4F9ED", sidebar_text_color:"#FFFFFF" },
    flamingo_fizz:    { primary_color:"#FF5978", secondary_color:"#C61C4E", body_color:"#FFF4F7", sidebar_text_color:"#FFFFFF" },
    graphite_slate:   { primary_color:"#5A6772", secondary_color:"#2B3136", body_color:"#F7F9FA", sidebar_text_color:"#FFFFFF" },
    lavender_mist:    { primary_color:"#C6B4E2", secondary_color:"#7A68AD", body_color:"#FBF8FF", sidebar_text_color:"#FFFFFF" },
    ruby_garnet:      { primary_color:"#C32630", secondary_color:"#80121A", body_color:"#FFF1F2", sidebar_text_color:"#FFFFFF" },
    pearl_shell:      { primary_color:"#F2E8DC", secondary_color:"#B9A896", body_color:"#FFFFFF", sidebar_text_color:"#4A4A4A" },
    steel_teal:       { primary_color:"#508F8C", secondary_color:"#275655", body_color:"#F1F8F8", sidebar_text_color:"#FFFFFF" },
    apricot_glow:     { primary_color:"#FFBFA3", secondary_color:"#C97C55", body_color:"#FFF8F4", sidebar_text_color:"#4A4A4A" },
    cactus_green:     { primary_color:"#5B8E3C", secondary_color:"#2E4A1A", body_color:"#F4FAF0", sidebar_text_color:"#FFFFFF" },
    night_fall:       { primary_color:"#1F2A44", secondary_color:"#0E1425", body_color:"#EBEDF3", sidebar_text_color:"#FFFFFF" },
    sky_morning:      { primary_color:"#7DB9FF", secondary_color:"#1E6FE4", body_color:"#EFF6FF", sidebar_text_color:"#FFFFFF" },
    rosewood:         { primary_color:"#A73846", secondary_color:"#611F25", body_color:"#FFF5F7", sidebar_text_color:"#FFFFFF" },
    glacier_frost:    { primary_color:"#9FD6EB", secondary_color:"#3B8FB1", body_color:"#F3FAFD", sidebar_text_color:"#FFFFFF" },
    sand_dune:        { primary_color:"#E3C07B", secondary_color:"#A37A28", body_color:"#FFFBF1", sidebar_text_color:"#4A4A4A" },
    lagoon_blue:      { primary_color:"#2AB3BF", secondary_color:"#106369", body_color:"#E8FAFC", sidebar_text_color:"#FFFFFF" },
    lilac_dream:      { primary_color:"#D7B5F8", secondary_color:"#925FD4", body_color:"#F9F4FF", sidebar_text_color:"#FFFFFF" },
    crimson_tide:     { primary_color:"#E5383B", secondary_color:"#962025", body_color:"#FFF2F3", sidebar_text_color:"#FFFFFF" },
    gold_leaf:        { primary_color:"#D4AF37", secondary_color:"#8C6E11", body_color:"#FFFBE7", sidebar_text_color:"#4A4A4A" },
    azure_skies:      { primary_color:"#0096FF", secondary_color:"#005F9E", body_color:"#E7F4FF", sidebar_text_color:"#FFFFFF" },
    pumpkin_spice:    { primary_color:"#E87E29", secondary_color:"#A34F0E", body_color:"#FFF6EF", sidebar_text_color:"#FFFFFF" },
    mint_chocolate:   { primary_color:"#70C1B3", secondary_color:"#3E675F", body_color:"#F0FBF9", sidebar_text_color:"#FFFFFF" },
    arctic_night:     { primary_color:"#2E3A4E", secondary_color:"#0D121A", body_color:"#EDF0F5", sidebar_text_color:"#FFFFFF" },
    pistachio_swirl:  { primary_color:"#A3D977", secondary_color:"#5E8F37", body_color:"#F6FCEF", sidebar_text_color:"#4A4A4A" },
    cherry_pop:       { primary_color:"#FF4F64", secondary_color:"#B8001B", body_color:"#FFF5F7", sidebar_text_color:"#FFFFFF" },
    dusky_pink:       { primary_color:"#D48A9E", secondary_color:"#93475A", body_color:"#FFF6F8", sidebar_text_color:"#FFFFFF" },
    noir_eclipse:     { primary_color:"#1B1B1B", secondary_color:"#000000", body_color:"#EFEFEF", sidebar_text_color:"#FFFFFF" },
    banana_cream:     { primary_color:"#FFE89E", secondary_color:"#C4A44F", body_color:"#FFFDF4", sidebar_text_color:"#4A4A4A" },
    cinnamon_roll:    { primary_color:"#C97A4B", secondary_color:"#7A4524", body_color:"#FFF8F3", sidebar_text_color:"#FFFFFF" },
    arctic_ocean:     { primary_color:"#3AA9CF", secondary_color:"#246C84", body_color:"#E9F7FD", sidebar_text_color:"#FFFFFF" },
    thunder_gray:     { primary_color:"#6F7C85", secondary_color:"#3C454A", body_color:"#F7F9FA", sidebar_text_color:"#FFFFFF" },
    sunset_glow:      { primary_color:"#FF9564", secondary_color:"#CC5930", body_color:"#FFF3EE", sidebar_text_color:"#FFFFFF" },
    honey_mustard:    { primary_color:"#CFA94F", secondary_color:"#8A6B05", body_color:"#FFF9E8", sidebar_text_color:"#4A4A4A" },
    basil_leaf:       { primary_color:"#487D49", secondary_color:"#254125", body_color:"#F2F9F2", sidebar_text_color:"#FFFFFF" },
    royal_maroon:     { primary_color:"#702963", secondary_color:"#42163B", body_color:"#F9F4FA", sidebar_text_color:"#FFFFFF" },
    powder_blue:      { primary_color:"#B5D4E5", secondary_color:"#678CA4", body_color:"#F6FBFF", sidebar_text_color:"#4A4A4A" },
    antique_gold:     { primary_color:"#C19A56", secondary_color:"#846423", body_color:"#FFFAF0", sidebar_text_color:"#4A4A4A" },
    bubblegum:        { primary_color:"#FF6FAA", secondary_color:"#C62570", body_color:"#FFF4FA", sidebar_text_color:"#FFFFFF" },
    dusty_rose:       { primary_color:"#C4A69F", secondary_color:"#8C6B64", body_color:"#FDF8F6", sidebar_text_color:"#4A4A4A" },
    carbon_black:     { primary_color:"#2A2A2A", secondary_color:"#000000", body_color:"#F1F1F1", sidebar_text_color:"#FFFFFF" },
    teal_wave:        { primary_color:"#009CA6", secondary_color:"#005259", body_color:"#E6F8F9", sidebar_text_color:"#FFFFFF" },
    frost_white:      { primary_color:"#FFFFFF", secondary_color:"#BFC4C9", body_color:"#FFFFFF", sidebar_text_color:"#2B2B2B" },
sunrise_peach:   { primary_color:"#FFBC8A", secondary_color:"#D97A52", body_color:"#FFF6F1", sidebar_text_color:"#4A4A4A" },
arctic_breeze:   { primary_color:"#AEEAF7", secondary_color:"#3B9ABF", body_color:"#F2FCFF", sidebar_text_color:"#FFFFFF" },
cobalt_dream:    { primary_color:"#2B6CB0", secondary_color:"#123A66", body_color:"#EDF4FF", sidebar_text_color:"#FFFFFF" },
mulberry_milk:   { primary_color:"#C27BA0", secondary_color:"#7A4563", body_color:"#FFF6FB", sidebar_text_color:"#FFFFFF" },
pine_forest:     { primary_color:"#2E5937", secondary_color:"#19311E", body_color:"#EFF7F1", sidebar_text_color:"#FFFFFF" },
sandstone_blush: { primary_color:"#E8C0A0", secondary_color:"#A67854", body_color:"#FFF9F5", sidebar_text_color:"#4A4A4A" },
oasis_green:     { primary_color:"#3BAA5C", secondary_color:"#1D6031", body_color:"#F1FAF4", sidebar_text_color:"#FFFFFF" },
firebrick:       { primary_color:"#B22222", secondary_color:"#6E1313", body_color:"#FFEEF0", sidebar_text_color:"#FFFFFF" },
periwinkle_bay:  { primary_color:"#8AA9FF", secondary_color:"#4867C4", body_color:"#F3F6FF", sidebar_text_color:"#FFFFFF" },
sunflower_field: { primary_color:"#FFCE3D", secondary_color:"#B48A00", body_color:"#FFFBE6", sidebar_text_color:"#4A4A4A" },

ocean_mist:      { primary_color:"#78D1E1", secondary_color:"#1A7E93", body_color:"#EAFBFF", sidebar_text_color:"#FFFFFF" },
storm_cloud:     { primary_color:"#616E7C", secondary_color:"#323B45", body_color:"#F8FAFB", sidebar_text_color:"#FFFFFF" },
marigold_sunset: { primary_color:"#FFAD32", secondary_color:"#C77500", body_color:"#FFF6E8", sidebar_text_color:"#4A4A4A" },
cranberry_crush: { primary_color:"#C21E56", secondary_color:"#7E1136", body_color:"#FFF1F6", sidebar_text_color:"#FFFFFF" },
buttercup:       { primary_color:"#FFD447", secondary_color:"#C79B00", body_color:"#FFFCEB", sidebar_text_color:"#4A4A4A" },
celestial_blue:  { primary_color:"#5DA8FF", secondary_color:"#0F5ACA", body_color:"#E9F2FF", sidebar_text_color:"#FFFFFF" },
marine_teal:     { primary_color:"#2AA39A", secondary_color:"#0E5852", body_color:"#E9FBF9", sidebar_text_color:"#FFFFFF" },
orchid_haze:     { primary_color:"#D0A4E3", secondary_color:"#8254AD", body_color:"#FBF5FF", sidebar_text_color:"#FFFFFF" },
copper_rust:     { primary_color:"#B66A3C", secondary_color:"#6A3B1E", body_color:"#FFF6F2", sidebar_text_color:"#FFFFFF" },
ginger_snap:     { primary_color:"#CF8A4B", secondary_color:"#864D1C", body_color:"#FFF8F0", sidebar_text_color:"#FFFFFF" },

indigo_wave:     { primary_color:"#4F5BD5", secondary_color:"#26307D", body_color:"#EEF0FF", sidebar_text_color:"#FFFFFF" },
sage_mist:       { primary_color:"#A9C4A5", secondary_color:"#657E62", body_color:"#F4FAF2", sidebar_text_color:"#4A4A4A" },
tuscany_sunset:  { primary_color:"#D67B45", secondary_color:"#9B4B1E", body_color:"#FFF4EE", sidebar_text_color:"#FFFFFF" },
amaranth_pink:   { primary_color:"#EC5C97", secondary_color:"#9B285B", body_color:"#FFF5FA", sidebar_text_color:"#FFFFFF" },
ivory_cream:     { primary_color:"#F9F5E9", secondary_color:"#B9B2A0", body_color:"#FFFFFF", sidebar_text_color:"#4A4A4A" },
charcoal_navy:   { primary_color:"#2C3E50", secondary_color:"#1A2431", body_color:"#EEF1F4", sidebar_text_color:"#FFFFFF" },
peacock_feather: { primary_color:"#00A3A6", secondary_color:"#005457", body_color:"#E6FAFA", sidebar_text_color:"#FFFFFF" },
platinum_silver: { primary_color:"#B8C2CC", secondary_color:"#737B83", body_color:"#F9FBFD", sidebar_text_color:"#2B2B2B" },
bamboo_forest:   { primary_color:"#4F772D", secondary_color:"#274015", body_color:"#F2F8F0", sidebar_text_color:"#FFFFFF" },
blizzard_blue:   { primary_color:"#A5D8FF", secondary_color:"#3A86C4", body_color:"#F2F9FF", sidebar_text_color:"#FFFFFF" },

lavender_field:  { primary_color:"#BFA2DB", secondary_color:"#735C9F", body_color:"#F9F6FF", sidebar_text_color:"#FFFFFF" },
autumn_rust:     { primary_color:"#CF5C36", secondary_color:"#7A3014", body_color:"#FFF2ED", sidebar_text_color:"#FFFFFF" },
petrol_blue:     { primary_color:"#005F73", secondary_color:"#00313A", body_color:"#E6F4F6", sidebar_text_color:"#FFFFFF" },
cocoa_butter:    { primary_color:"#EFD8C5", secondary_color:"#B59275", body_color:"#FFFDFC", sidebar_text_color:"#4A4A4A" },
red_velvet:      { primary_color:"#9B111E", secondary_color:"#60000E", body_color:"#FFEFF1", sidebar_text_color:"#FFFFFF" },
misty_rose:      { primary_color:"#E7B6BD", secondary_color:"#92616A", body_color:"#FFFAFB", sidebar_text_color:"#4A4A4A" },
silver_moon:     { primary_color:"#CED3DC", secondary_color:"#8B9097", body_color:"#FBFCFD", sidebar_text_color:"#2B2B2B" },
gold_rush:       { primary_color:"#E3B23C", secondary_color:"#8D6913", body_color:"#FFF9EC", sidebar_text_color:"#4A4A4A" },
olive_grove:     { primary_color:"#6C7A3D", secondary_color:"#40491F", body_color:"#F4F8EF", sidebar_text_color:"#FFFFFF" },
tropical_lime:   { primary_color:"#BBD80B", secondary_color:"#6E8800", body_color:"#F8FDEB", sidebar_text_color:"#4A4A4A" },

dusty_lavender:  { primary_color:"#C5A4C5", secondary_color:"#7B617B", body_color:"#FBF7FB", sidebar_text_color:"#4A4A4A" },
sandstone_beach: { primary_color:"#D6B98C", secondary_color:"#9E7A44", body_color:"#FFFBF5", sidebar_text_color:"#4A4A4A" },
azure_tide:      { primary_color:"#008CBA", secondary_color:"#005273", body_color:"#E7F6FD", sidebar_text_color:"#FFFFFF" },
iced_latte:      { primary_color:"#D3B39C", secondary_color:"#8C6D57", body_color:"#FFF9F6", sidebar_text_color:"#4A4A4A" },
peach_sorbet:    { primary_color:"#FF9E85", secondary_color:"#D66A50", body_color:"#FFF4F0", sidebar_text_color:"#4A4A4A" },
evergreen:       { primary_color:"#054A29", secondary_color:"#032616", body_color:"#E6F5EC", sidebar_text_color:"#FFFFFF" },
sapphire_night:  { primary_color:"#1939B7", secondary_color:"#0E1E63", body_color:"#EEF1FF", sidebar_text_color:"#FFFFFF" },
copper_glow:     { primary_color:"#C8733D", secondary_color:"#7B4622", body_color:"#FFF6F2", sidebar_text_color:"#FFFFFF" },
violet_dream:    { primary_color:"#9D5AFF", secondary_color:"#5B2CBC", body_color:"#F4F0FF", sidebar_text_color:"#FFFFFF" },
graphite_shadow: { primary_color:"#444C54", secondary_color:"#1F2326", body_color:"#F9FAFB", sidebar_text_color:"#FFFFFF" },
 'moonstone_gray': { primary_color: '#A0A9B8', secondary_color: '#5A6575', body_color: '#F5F7FA', sidebar_text_color: '#FFFFFF' },
    'saffron_sunrise': { primary_color: '#FF9933', secondary_color: '#CC6600', body_color: '#FFF5E6', sidebar_text_color: '#FFFFFF' },
    'aquamarine_dream': { primary_color: '#7FFFD4', secondary_color: '#469F8C', body_color: '#E6F9F3', sidebar_text_color: '#FFFFFF' },
    'crimson_twilight': { primary_color: '#DC143C', secondary_color: '#8B0000', body_color: '#FFE8EC', sidebar_text_color: '#FFFFFF' },
    'juniper_fog': { primary_color: '#6C8B8F', secondary_color: '#3D5559', body_color: '#EDF1F2', sidebar_text_color: '#FFFFFF' },
    'orchid_mist': { primary_color: '#DA70D6', secondary_color: '#9932CC', body_color: '#FAF0FB', sidebar_text_color: '#FFFFFF' },
    'bronze_glow': { primary_color: '#CD7F32', secondary_color: '#8B5A2B', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF' },
    'cerulean_sky': { primary_color: '#2A52BE', secondary_color: '#1A3A8B', body_color: '#E6F0FF', sidebar_text_color: '#FFFFFF' },
    'emerald_deep': { primary_color: '#028A0F', secondary_color: '#015A09', body_color: '#E6F7E6', sidebar_text_color: '#FFFFFF' },
    'coral_burst': { primary_color: '#FF7F50', secondary_color: '#E34A2C', body_color: '#FFF1E6', sidebar_text_color: '#FFFFFF' },
    'midnight_velvet': { primary_color: '#2C1A4D', secondary_color: '#1A1033', body_color: '#F0EBF9', sidebar_text_color: '#E0D6F4' },
    'sunflower_field': { primary_color: '#FFC40C', secondary_color: '#D4A017', body_color: '#FFFDE7', sidebar_text_color: '#333333' },
    'sapphire_shimmer': { primary_color: '#0F52BA', secondary_color: '#082567', body_color: '#E6EDF7', sidebar_text_color: '#FFFFFF' },
    'blush_pink': { primary_color: '#FE828C', secondary_color: '#D94D63', body_color: '#FFEBED', sidebar_text_color: '#FFFFFF' },
    'pine_forest': { primary_color: '#2E8B57', secondary_color: '#1B5E20', body_color: '#E8F5E9', sidebar_text_color: '#FFFFFF' },
    'desert_mirage': { primary_color: '#E0B589', secondary_color: '#C19A6B', body_color: '#FDF5E6', sidebar_text_color: '#333333' },
    'amethyst_evening': { primary_color: '#9966CC', secondary_color: '#6A0DAD', body_color: '#F5F0FA', sidebar_text_color: '#FFFFFF' },
    'honey_gold': { primary_color: '#D4AF37', secondary_color: '#B8860B', body_color: '#FDF8E1', sidebar_text_color: '#333333' },
    'glacial_blue': { primary_color: '#9BD3DD', secondary_color: '#6BA8B5', body_color: '#F0F9FB', sidebar_text_color: '#333333' },
    'cinnamon_spice': { primary_color: '#D2691E', secondary_color: '#8B4513', body_color: '#FDF1E6', sidebar_text_color: '#FFFFFF' },
    'tropical_turquoise': { primary_color: '#40E0D0', secondary_color: '#2FB0A1', body_color: '#E6F9F7', sidebar_text_color: '#FFFFFF' },
    'berry_sorbet': { primary_color: '#D74177', secondary_color: '#9D2B5D', body_color: '#FCE8EF', sidebar_text_color: '#FFFFFF' },
    'steel_blue': { primary_color: '#4682B4', secondary_color: '#2A4E6C', body_color: '#E6EEF5', sidebar_text_color: '#FFFFFF' },
    'sunset_lavender': { primary_color: '#E6B0AA', secondary_color: '#C39BD3', body_color: '#F9F0F5', sidebar_text_color: '#333333' },
    'mossy_terrain': { primary_color: '#8A9A5B', secondary_color: '#556B2F', body_color: '#F0F4E8', sidebar_text_color: '#FFFFFF' },
    'peacock_pride': { primary_color: '#026873', secondary_color: '#024059', body_color: '#E6F0F2', sidebar_text_color: '#FFFFFF' },
    'mauve_mystery': { primary_color: '#915F6D', secondary_color: '#614051', body_color: '#F5EFF1', sidebar_text_color: '#FFFFFF' },
    'caramel_latte': { primary_color: '#D2B48C', secondary_color: '#A67C52', body_color: '#FDF8F0', sidebar_text_color: '#333333' },
    'arctic_aurora': { primary_color: '#78C7C7', secondary_color: '#4A9C9C', body_color: '#E6F4F4', sidebar_text_color: '#FFFFFF' },
    'fiery_sunset': { primary_color: '#FF4500', secondary_color: '#CC3700', body_color: '#FFEFE6', sidebar_text_color: '#FFFFFF' },
    'deep_emerald': { primary_color: '#046307', secondary_color: '#023C03', body_color: '#E6F4E6', sidebar_text_color: '#FFFFFF' },
    'ocean_foam': { primary_color: '#A7D2D2', secondary_color: '#6F9E9E', body_color: '#F0F9F9', sidebar_text_color: '#333333' },
    'royal_plum': { primary_color: '#6C3082', secondary_color: '#4A235A', body_color: '#F2EAF5', sidebar_text_color: '#FFFFFF' },
    'golden_wheat': { primary_color: '#F5DEB3', secondary_color: '#D2B48C', body_color: '#FFFDF0', sidebar_text_color: '#333333' },
    'silver_moon': { primary_color: '#C0C0C0', secondary_color: '#808080', body_color: '#F5F5F5', sidebar_text_color: '#333333' },
    'raspberry_riot': { primary_color: '#E30B5C', secondary_color: '#A30945', body_color: '#FDE8EF', sidebar_text_color: '#FFFFFF' },
    'teal_tide': { primary_color: '#008080', secondary_color: '#006666', body_color: '#E0F2F1', sidebar_text_color: '#FFFFFF' },
    'chocolate_cherry': { primary_color: '#7B3F00', secondary_color: '#4D2600', body_color: '#F5EDE6', sidebar_text_color: '#FFFFFF' },
    'skyline_blue': { primary_color: '#87CEEB', secondary_color: '#5F9EA0', body_color: '#E6F7FF', sidebar_text_color: '#333333' },
    'citrus_zest': { primary_color: '#F4CA16', secondary_color: '#C9A227', body_color: '#FFFDE7', sidebar_text_color: '#333333' },
    'violet_vogue': { primary_color: '#8A2BE2', secondary_color: '#6A0DAD', body_color: '#F3E5F5', sidebar_text_color: '#FFFFFF' },
    'mint_mojito': { primary_color: '#98FF98', secondary_color: '#77DD77', body_color: '#F0FFF0', sidebar_text_color: '#333333' },
    'copper_canyon': { primary_color: '#B87333', secondary_color: '#8B5A2B', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF' },
    'deep_space': { primary_color: '#414A4C', secondary_color: '#232B2B', body_color: '#1C1C1C', sidebar_text_color: '#E0E0E0' },
    'buttercup_yellow': { primary_color: '#F6E05E', secondary_color: '#D4B83C', body_color: '#FFFDE7', sidebar_text_color: '#333333' },
    'berry_wine': { primary_color: '#722F37', secondary_color: '#4D1A21', body_color: '#F5E7E9', sidebar_text_color: '#FFFFFF' },
    'seafoam_splash': { primary_color: '#93E9BE', secondary_color: '#5F9E7F', body_color: '#E6F7EF', sidebar_text_color: '#333333' },
    'smoke_gray': { primary_color: '#848884', secondary_color: '#5D6D5D', body_color: '#F0F2F0', sidebar_text_color: '#333333' },
    'coral_reef': { primary_color: '#FF6B6B', secondary_color: '#FF4D4D', body_color: '#FFE8E8', sidebar_text_color: '#FFFFFF' },
    'lavender_field': { primary_color: '#B57EDC', secondary_color: '#8A5F8E', body_color: '#F5F0FA', sidebar_text_color: '#FFFFFF' },
    'pumpkin_spice': { primary_color: '#FF7518', secondary_color: '#CC5803', body_color: '#FFF0E6', sidebar_text_color: '#FFFFFF' },
    'glacier_green': { primary_color: '#8FBC8F', secondary_color: '#5F8B5F', body_color: '#F0F8F0', sidebar_text_color: '#333333' },
    'merlot_magic': { primary_color: '#800000', secondary_color: '#4D0000', body_color: '#F2E6E6', sidebar_text_color: '#FFFFFF' },
    'tangerine_tango': { primary_color: '#FF7700', secondary_color: '#CC5C00', body_color: '#FFF0E0', sidebar_text_color: '#FFFFFF' },
    'oasis_blue': { primary_color: '#5D8AA8', secondary_color: '#3D5D6F', body_color: '#E6EDF2', sidebar_text_color: '#FFFFFF' },
    'platinum_frost': { primary_color: '#E5E4E2', secondary_color: '#B6B6B4', body_color: '#F5F5F5', sidebar_text_color: '#333333' },
    'ruby_red': { primary_color: '#E0115F', secondary_color: '#9B0B43', body_color: '#FCE8EF', sidebar_text_color: '#FFFFFF' },
    'lime_sorbet': { primary_color: '#32CD32', secondary_color: '#228B22', body_color: '#F0FFF0', sidebar_text_color: '#FFFFFF' },
    'dusk_purple': { primary_color: '#4B0082', secondary_color: '#32004B', body_color: '#EDE6F5', sidebar_text_color: '#FFFFFF' },
    'sand_dune': { primary_color: '#C2B280', secondary_color: '#8C7C4D', body_color: '#F5F2E6', sidebar_text_color: '#333333' },
    'lagoon_blue': { primary_color: '#1D7CF2', secondary_color: '#0D5CBD', body_color: '#E6F0FF', sidebar_text_color: '#FFFFFF' },
    'rose_quartz': { primary_color: '#F7CAC9', secondary_color: '#D4A5A5', body_color: '#FDF5F5', sidebar_text_color: '#333333' },
    'bronzed_earth': { primary_color: '#80461B', secondary_color: '#5D3413', body_color: '#F5EDE6', sidebar_text_color: '#FFFFFF' },
    'frosted_lilac': { primary_color: '#DCD0FF', secondary_color: '#B8A1D9', body_color: '#F5F0FF', sidebar_text_color: '#333333' },
    'sangria_night': { primary_color: '#7C3030', secondary_color: '#4D1A1A', body_color: '#F5E6E6', sidebar_text_color: '#FFFFFF' },
    'citrine_yellow': { primary_color: '#E4D00A', secondary_color: '#B3A708', body_color: '#FFFDE7', sidebar_text_color: '#333333' },
    'deep_sea': { primary_color: '#0077BE', secondary_color: '#005A8C', body_color: '#E6F0F7', sidebar_text_color: '#FFFFFF' },
    'terra_cotta': { primary_color: '#E2725B', secondary_color: '#C05A40', body_color: '#FDF0ED', sidebar_text_color: '#FFFFFF' },
    'arctic_white': { primary_color: '#F8F8FF', secondary_color: '#D3D3D3', body_color: '#FFFFFF', sidebar_text_color: '#333333' },
    'magenta_mood': { primary_color: '#FF00FF', secondary_color: '#CC00CC', body_color: '#FFE6FF', sidebar_text_color: '#FFFFFF' },
    'olive_garden': { primary_color: '#556B2F', secondary_color: '#3D4A23', body_color: '#F0F4E8', sidebar_text_color: '#FFFFFF' },
    'blue_steel': { primary_color: '#4682B4', secondary_color: '#355E7D', body_color: '#E6EDF5', sidebar_text_color: '#FFFFFF' },
    'peach_parfait': { primary_color: '#FFDAB9', secondary_color: '#F4A460', body_color: '#FFF5E6', sidebar_text_color: '#333333' },
    'twilight_blue': { primary_color: '#0A2463', secondary_color: '#071A4A', body_color: '#E6E9F0', sidebar_text_color: '#FFFFFF' },
    'mocha_brown': { primary_color: '#6F4E37', secondary_color: '#4D3625', body_color: '#F5F0ED', sidebar_text_color: '#FFFFFF' },
    'jade_stone': { primary_color: '#00A86B', secondary_color: '#007A4D', body_color: '#E6F5EF', sidebar_text_color: '#FFFFFF' },
    'crimson_sun': { primary_color: '#DC381F', secondary_color: '#A3291A', body_color: '#FFEDEA', sidebar_text_color: '#FFFFFF' },
    'mint_julep': { primary_color: '#98FB98', secondary_color: '#77DD77', body_color: '#F0FFF0', sidebar_text_color: '#333333' },
    'purple_rain': { primary_color: '#A020F0', secondary_color: '#7D26CD', body_color: '#F5E6FF', sidebar_text_color: '#FFFFFF' },
    'golden_apricot': { primary_color: '#FBCEB1', secondary_color: '#F4A460', body_color: '#FFF5ED', sidebar_text_color: '#333333' },
    'ocean_depth': { primary_color: '#123456', secondary_color: '#0A1F33', body_color: '#E6EBF0', sidebar_text_color: '#FFFFFF' },
    'cranberry_crush': { primary_color: '#9F000F', secondary_color: '#6F000A', body_color: '#F5E6E8', sidebar_text_color: '#FFFFFF' },
    'silver_sage': { primary_color: '#8A9A5B', secondary_color: '#6B7D4D', body_color: '#F0F4E8', sidebar_text_color: '#333333' },
    'amber_glow': { primary_color: '#FFBF00', secondary_color: '#CC9900', body_color: '#FFF8E0', sidebar_text_color: '#333333' },
    'deep_lavender': { primary_color: '#734F96', secondary_color: '#543D6F', body_color: '#F0EAF5', sidebar_text_color: '#FFFFFF' },
    'desert_sun': { primary_color: '#E3A857', secondary_color: '#C08A3F', body_color: '#FFF5E6', sidebar_text_color: '#333333' },
    'emerald_city': { primary_color: '#50C878', secondary_color: '#3D9D5F', body_color: '#E6F5EB', sidebar_text_color: '#FFFFFF' },
    'blush_beige': { primary_color: '#F5F5DC', secondary_color: '#D2B48C', body_color: '#FFFDF0', sidebar_text_color: '#333333' },
    'navy_night': { primary_color: '#000080', secondary_color: '#00004D', body_color: '#E6E6F0', sidebar_text_color: '#FFFFFF' },
    'sunny_lemon': { primary_color: '#FFF44F', secondary_color: '#D9D143', body_color: '#FFFDE7', sidebar_text_color: '#333333' },
    'plum_passion': { primary_color: '#8E4585', secondary_color: '#6B3467', body_color: '#F5F0F5', sidebar_text_color: '#FFFFFF' },
    'forest_fog': { primary_color: '#5F8D4E', secondary_color: '#3D5B3D', body_color: '#EDF2E9', sidebar_text_color: '#FFFFFF' },
    'cobalt_sea': { primary_color: '#0047AB', secondary_color: '#003380', body_color: '#E6EDF5', sidebar_text_color: '#FFFFFF' },
    'coral_charm': { primary_color: '#E68080', secondary_color: '#D46A6A', body_color: '#FFE8E8', sidebar_text_color: '#FFFFFF' },
    'champagne_gold': { primary_color: '#F7E7CE', secondary_color: '#E5D0B1', body_color: '#FFFDF0', sidebar_text_color: '#333333' },
    'misty_rose': { primary_color: '#FFE4E1', secondary_color: '#F4C2C2', body_color: '#FFF5F5', sidebar_text_color: '#333333' },
    'pineapple_yellow': { primary_color: '#FEE12B', secondary_color: '#F4CA16', body_color: '#FFFDE7', sidebar_text_color: '#333333' },
    'royal_amethyst': { primary_color: '#6A5ACD', secondary_color: '#483D8B', body_color: '#EDEAF5', sidebar_text_color: '#FFFFFF' },
    'coastal_breeze': { primary_color: '#B3E5FC', secondary_color: '#81D4FA', body_color: '#E6F7FF', sidebar_text_color: '#333333' },
    'chocolate_truffle': { primary_color: '#5D4037', secondary_color: '#3E2723', body_color: '#EFEBE9', sidebar_text_color: '#FFFFFF' },
    'frost_blue': { primary_color: '#5D8AA8', secondary_color: '#3D5D6F', body_color: '#E6EDF2', sidebar_text_color: '#FFFFFF' },
    'raspberry_rose': { primary_color: '#E25098', secondary_color: '#C2185B', body_color: '#FCE8F1', sidebar_text_color: '#FFFFFF' },
    'olive_oil': { primary_color: '#808000', secondary_color: '#556B2F', body_color: '#F0F4E8', sidebar_text_color: '#FFFFFF' },
    'sky_azure': { primary_color: '#007FFF', secondary_color: '#005FCC', body_color: '#E6F0FF', sidebar_text_color: '#FFFFFF' },
    'pear_green': { primary_color: '#D1E231', secondary_color: '#A9C42D', body_color: '#F7FBE6', sidebar_text_color: '#333333' },
    'burgundy_velvet': { primary_color: '#800020', secondary_color: '#4D0013', body_color: '#F2E6E9', sidebar_text_color: '#FFFFFF' },
    'sandy_beach': { primary_color: '#FAD6A5', secondary_color: '#E6BE8A', body_color: '#FFF5E6', sidebar_text_color: '#333333' },
    'deep_purple': { primary_color: '#36013F', secondary_color: '#23012B', body_color: '#F0E6F2', sidebar_text_color: '#FFFFFF' },
    'goldenrod_field': { primary_color: '#DAA520', secondary_color: '#B8860B', body_color: '#FFF8E0', sidebar_text_color: '#333333' },
    'glacier_blue': { primary_color: '#78C7C7', secondary_color: '#4A9C9C', body_color: '#E6F4F4', sidebar_text_color: '#FFFFFF' },
    'mulberry_wine': { primary_color: '#770737', secondary_color: '#4D0525', body_color: '#F2E6EB', sidebar_text_color: '#FFFFFF' },
    'seaglass_green': { primary_color: '#20B2AA', secondary_color: '#008080', body_color: '#E6F4F3', sidebar_text_color: '#FFFFFF' },
    'sunset_gold': { primary_color: '#FFD700', secondary_color: '#D4AF37', body_color: '#FFFDE0', sidebar_text_color: '#333333' },
    'deep_teal': { primary_color: '#006D6F', secondary_color: '#004D4F', body_color: '#E6F2F2', sidebar_text_color: '#FFFFFF' },
    'blossom_pink': { primary_color: '#FFB7C5', secondary_color: '#FF91A4', body_color: '#FFF0F3', sidebar_text_color: '#333333' },
    'sandstone_canyon': { primary_color: '#B8A188', secondary_color: '#8C7C65', body_color: '#F5F2ED', sidebar_text_color: '#333333' },
    'royal_jade': { primary_color: '#00A86B', secondary_color: '#007A4D', body_color: '#E6F5EF', sidebar_text_color: '#FFFFFF' },
    'copper_penny': { primary_color: '#AD6F69', secondary_color: '#8C524D', body_color: '#F5EDEC', sidebar_text_color: '#FFFFFF' },
    'midnight_iris': { primary_color: '#4B0082', secondary_color: '#32004B', body_color: '#EDE6F5', sidebar_text_color: '#FFFFFF' },
    'lemon_ice': { primary_color: '#FDFF00', secondary_color: '#D1D100', body_color: '#FFFFE0', sidebar_text_color: '#333333' },
    'berry_blast': { primary_color: '#A4243B', secondary_color: '#7A1B2C', body_color: '#F5E6E9', sidebar_text_color: '#FFFFFF' },
    'ocean_storm': { primary_color: '#4169E1', secondary_color: '#2A4E9C', body_color: '#E6EDF7', sidebar_text_color: '#FFFFFF' },
    'camel_tan': { primary_color: '#C19A6B', secondary_color: '#8C6B4F', body_color: '#F5F0ED', sidebar_text_color: '#333333' },
    'lilac_bloom': { primary_color: '#C8A2C8', secondary_color: '#9D72A8', body_color: '#F5F0F7', sidebar_text_color: '#333333' },
    'sunburnt_orange': { primary_color: '#FF7F50', secondary_color: '#E66C3A', body_color: '#FFF0E6', sidebar_text_color: '#FFFFFF' },
    'marine_blue': { primary_color: '#0D3B66', secondary_color: '#0A2A4A', body_color: '#E6EBF0', sidebar_text_color: '#FFFFFF' },
    'honey_mustard': { primary_color: '#FFD300', secondary_color: '#D4B000', body_color: '#FFFDE0', sidebar_text_color: '#333333' },
    'plum_perfect': { primary_color: '#8E4585', secondary_color: '#6B3467', body_color: '#F5F0F5', sidebar_text_color: '#FFFFFF' },
    'aspen_gold': { primary_color: '#FFD700', secondary_color: '#D4AF37', body_color: '#FFFDE0', sidebar_text_color: '#333333' },
    'deep_rose': { primary_color: '#C21E56', secondary_color: '#8C1440', body_color: '#F5E6EB', sidebar_text_color: '#FFFFFF' },
    'aqua_marine': { primary_color: '#7FFFD4', secondary_color: '#5F9E7F', body_color: '#E6F7F0', sidebar_text_color: '#333333' },
    'cocoa_brown': { primary_color: '#D2691E', secondary_color: '#8B4513', body_color: '#FDF1E6', sidebar_text_color: '#FFFFFF' },
    'frosted_mint': { primary_color: '#98FF98', secondary_color: '#77DD77', body_color: '#F0FFF0', sidebar_text_color: '#333333' },
    'sunset_pink': { primary_color: '#FF91A4', secondary_color: '#FF6B8B', body_color: '#FFE8EC', sidebar_text_color: '#333333' },
    'pine_green': { primary_color: '#01796F', secondary_color: '#015D53', body_color: '#E6F2F1', sidebar_text_color: '#FFFFFF' },
    'royal_indigo': { primary_color: '#4B0082', secondary_color: '#32004B', body_color: '#EDE6F5', sidebar_text_color: '#FFFFFF' },
    'butterscotch': { primary_color: '#E3963E', secondary_color: '#C17D2F', body_color: '#FDF5E6', sidebar_text_color: '#333333' },
    'misty_morning': { primary_color: '#C0C0C0', secondary_color: '#A9A9A9', body_color: '#F0F0F0', sidebar_text_color: '#333333' },
    'blueberry_blue': { primary_color: '#4F86F7', secondary_color: '#2D5BBF', body_color: '#E6EDFF', sidebar_text_color: '#FFFFFF' },
    'terracotta_red': { primary_color: '#E2725B', secondary_color: '#C05A40', body_color: '#FDF0ED', sidebar_text_color: '#FFFFFF' },
    'seafarer_blue': { primary_color: '#1E3A8A', secondary_color: '#142B66', body_color: '#E6EBF5', sidebar_text_color: '#FFFFFF' },
    'peach_bloom': { primary_color: '#FFCBA4', secondary_color: '#F4A460', body_color: '#FFF5ED', sidebar_text_color: '#333333' },
    'dusky_lavender': { primary_color: '#6C4675', secondary_color: '#4D3354', body_color: '#F0EAF2', sidebar_text_color: '#FFFFFF' },
    'amber_autumn': { primary_color: '#FF8C00', secondary_color: '#CC7000', body_color: '#FFF0E0', sidebar_text_color: '#FFFFFF' },
    'deep_sky': { primary_color: '#00BFFF', secondary_color: '#0080FF', body_color: '#E6F7FF', sidebar_text_color: '#FFFFFF' },
    'mossy_oak': { primary_color: '#8F9779', secondary_color: '#6B7357', body_color: '#F0F2ED', sidebar_text_color: '#333333' },
    'rosewood_red': { primary_color: '#65000B', secondary_color: '#4D0008', body_color: '#F2E6E8', sidebar_text_color: '#FFFFFF' },
    'lagoon_reflection': { primary_color: '#00CED1', secondary_color: '#008B8B', body_color: '#E6F7F7', sidebar_text_color: '#FFFFFF' },
    'sunny_yellow': { primary_color: '#FFF44F', secondary_color: '#D9D143', body_color: '#FFFDE7', sidebar_text_color: '#333333' },
    'purple_haze': { primary_color: '#4E387E', secondary_color: '#392A5C', body_color: '#EDEAF5', sidebar_text_color: '#FFFFFF' },
    'desert_rose': { primary_color: '#CF6F7A', secondary_color: '#A94F59', body_color: '#FDF0F2', sidebar_text_color: '#FFFFFF' },
    'glacial_teal': { primary_color: '#6CADA9', secondary_color: '#4F8B87', body_color: '#E6F2F1', sidebar_text_color: '#FFFFFF' },
    'crimson_clover': { primary_color: '#DC143C', secondary_color: '#8B0000', body_color: '#FFE8EC', sidebar_text_color: '#FFFFFF' },
    'ocean_mist': { primary_color: '#B0E0E6', secondary_color: '#87CEEB', body_color: '#E6F7FF', sidebar_text_color: '#333333' },
    'bronze_olive': { primary_color: '#8C7853', secondary_color: '#6B5B40', body_color: '#F5F2ED', sidebar_text_color: '#FFFFFF' },
    'frosty_purple': { primary_color: '#D8BFD8', secondary_color: '#B19CD9', body_color: '#F5F0F7', sidebar_text_color: '#333333' },
    'sunny_orange': { primary_color: '#FFA500', secondary_color: '#CC8400', body_color: '#FFF0E0', sidebar_text_color: '#FFFFFF' },
    'deep_forest': { primary_color: '#014421', secondary_color: '#01301C', body_color: '#E6F0EB', sidebar_text_color: '#FFFFFF' },
    'pearl_white': { primary_color: '#F8F8FF', secondary_color: '#E0E0E0', body_color: '#FFFFFF', sidebar_text_color: '#333333' },
    'royal_ruby': { primary_color: '#9B111E', secondary_color: '#7A0D16', body_color: '#F5E6E8', sidebar_text_color: '#FFFFFF' },
    'minty_fresh': { primary_color: '#98FB98', secondary_color: '#77DD77', body_color: '#F0FFF0', sidebar_text_color: '#333333' },
    'copper_sunset': { primary_color: '#B87333', secondary_color: '#8C5D2B', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF' },
    'deep_water': { primary_color: '#0A1F33', secondary_color: '#071625', body_color: '#E6EBF0', sidebar_text_color: '#FFFFFF' },
    'autumn_red': { primary_color: '#D10000', secondary_color: '#9B0000', body_color: '#FFE6E6', sidebar_text_color: '#FFFFFF' },
    'glacier_gray': { primary_color: '#C0C0C0', secondary_color: '#A9A9A9', body_color: '#F0F0F0', sidebar_text_color: '#333333' },
    'berry_cheesecake': { primary_color: '#F8BBD0', secondary_color: '#F48FB1', body_color: '#FDF5F8', sidebar_text_color: '#333333' },
    'sandy_cove': { primary_color: '#E1C16E', secondary_color: '#C9A957', body_color: '#FFF8E0', sidebar_text_color: '#333333' },
    'twilight_purple': { primary_color: '#4B0082', secondary_color: '#32004B', body_color: '#EDE6F5', sidebar_text_color: '#FFFFFF' },
    'golden_sun': { primary_color: '#FFD700', secondary_color: '#D4AF37', body_color: '#FFFDE0', sidebar_text_color: '#333333' },
    'marine_green': { primary_color: '#2E8B57', secondary_color: '#1B5E20', body_color: '#E8F5E9', sidebar_text_color: '#FFFFFF' },
    'blush_wine': { primary_color: '#722F37', secondary_color: '#4D1A21', body_color: '#F5E7E9', sidebar_text_color: '#FFFFFF' },
    'mossy_rock': { primary_color: '#8A9A5B', secondary_color: '#6B7D4D', body_color: '#F0F4E8', sidebar_text_color: '#333333' },
    'arctic_blue': { primary_color: '#ADD8E6', secondary_color: '#87CEEB', body_color: '#E6F7FF', sidebar_text_color: '#333333' },
    'spiced_orange': { primary_color: '#FF7F50', secondary_color: '#E66C3A', body_color: '#FFF0E6', sidebar_text_color: '#FFFFFF' },
    'deep_plum': { primary_color: '#4B0150', secondary_color: '#35003A', body_color: '#F0E6F2', sidebar_text_color: '#FFFFFF' },
    'ocean_blue': { primary_color: '#0077BE', secondary_color: '#005A8C', body_color: '#E6F0F7', sidebar_text_color: '#FFFFFF' },
    'sunny_green': { primary_color: '#7CFC00', secondary_color: '#5CB800', body_color: '#F0FFE0', sidebar_text_color: '#333333' },
    'royal_blue': { primary_color: '#4169E1', secondary_color: '#2A4E9C', body_color: '#E6EDF7', sidebar_text_color: '#FFFFFF' },
    'caramel_apple': { primary_color: '#DEB887', secondary_color: '#CDA27C', body_color: '#FDF5ED', sidebar_text_color: '#333333' },
    'frosted_teal': { primary_color: '#88D8C0', secondary_color: '#5F9E7F', body_color: '#E6F7F0', sidebar_text_color: '#333333' },
    'sunset_red': { primary_color: '#FF4500', secondary_color: '#CC3700', body_color: '#FFEFE6', sidebar_text_color: '#FFFFFF' },
    'deep_emerald': { primary_color: '#046307', secondary_color: '#023C03', body_color: '#E6F4E6', sidebar_text_color: '#FFFFFF' },
    'misty_blue': { primary_color: '#B0C4DE', secondary_color: '#8FA8C8', body_color: '#E6EDF5', sidebar_text_color: '#333333' },
    'copper_rose': { primary_color: '#B87333', secondary_color: '#8C5D2B', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF' },
    'glacial_purple': { primary_color: '#B19CD9', secondary_color: '#8A72C4', body_color: '#F0EAF5', sidebar_text_color: '#333333' },
    'berry_smoothie': { primary_color: '#D74177', secondary_color: '#9D2B5D', body_color: '#FCE8EF', sidebar_text_color: '#FFFFFF' },
    'sandy_trail': { primary_color: '#E1C16E', secondary_color: '#C9A957', body_color: '#FFF8E0', sidebar_text_color: '#333333' },
    'twilight_teal': { primary_color: '#008080', secondary_color: '#006666', body_color: '#E0F2F1', sidebar_text_color: '#FFFFFF' },
    'golden_glow': { primary_color: '#FFD700', secondary_color: '#D4AF37', body_color: '#FFFDE0', sidebar_text_color: '#333333' },
    'marine_teal': { primary_color: '#008080', secondary_color: '#006666', body_color: '#E0F2F1', sidebar_text_color: '#FFFFFF' },
    'blush_coral': { primary_color: '#FF6B6B', secondary_color: '#FF4D4D', body_color: '#FFE8E8', sidebar_text_color: '#FFFFFF' },
    'mossy_green': { primary_color: '#8A9A5B', secondary_color: '#6B7D4D', body_color: '#F0F4E8', sidebar_text_color: '#333333' },
    'arctic_green': { primary_color: '#7FFFD4', secondary_color: '#5F9E7F', body_color: '#E6F7EF', sidebar_text_color: '#333333' },
    'spiced_wine': { primary_color: '#7C3030', secondary_color: '#4D1A1A', body_color: '#F5E6E6', sidebar_text_color: '#FFFFFF' },
    'deep_cyan': { primary_color: '#008B8B', secondary_color: '#006666', body_color: '#E0F2F2', sidebar_text_color: '#FFFFFF' },
    'oasis_green': { primary_color: '#32CD32', secondary_color: '#228B22', body_color: '#F0FFF0', sidebar_text_color: '#FFFFFF' },
    'sunny_coral': { primary_color: '#FF7F50', secondary_color: '#E66C3A', body_color: '#FFF0E6', sidebar_text_color: '#FFFFFF' },
    'royal_purple': { primary_color: '#6A0DAD', secondary_color: '#4A0072', body_color: '#F0E6F5', sidebar_text_color: '#FFFFFF' },
    'caramel_dream': { primary_color: '#E3963E', secondary_color: '#C17D2F', body_color: '#FDF5E6', sidebar_text_color: '#333333' },
    'frosted_rose': { primary_color: '#F8BBD0', secondary_color: '#F48FB1', body_color: '#FDF5F8', sidebar_text_color: '#333333' },
    'sunset_orange': { primary_color: '#FF7700', secondary_color: '#CC5C00', body_color: '#FFF0E0', sidebar_text_color: '#FFFFFF' },
    'deep_jade': { primary_color: '#00A36C', secondary_color: '#007A4D', body_color: '#E6F5EF', sidebar_text_color: '#FFFFFF' },
    'misty_lavender': { primary_color: '#DCD0FF', secondary_color: '#B8A1D9', body_color: '#F5F0FF', sidebar_text_color: '#333333' },
    'copper_glow': { primary_color: '#B87333', secondary_color: '#8C5D2B', body_color: '#FDF5E6', sidebar_text_color: '#FFFFFF' },
    'glacial_ice': { primary_color: '#B0E0E6', secondary_color: '#87CEEB', body_color: '#E6F7FF', sidebar_text_color: '#333333' },
    'berry_delight': { primary_color: '#E25098', secondary_color: '#C2185B', body_color: '#FCE8F1', sidebar_text_color: '#FFFFFF' },
    'sandy_desert': { primary_color: '#EDC9AF', secondary_color: '#D2B48C', body_color: '#FDF5E6', sidebar_text_color: '#333333' },
    'twilight_blue': { primary_color: '#0A2463', secondary_color: '#071A4A', body_color: '#E6E9F0', sidebar_text_color: '#FFFFFF' },
    'golden_hour': { primary_color: '#FFD700', secondary_color: '#D4AF37', body_color: '#FFFDE0', sidebar_text_color: '#333333' },
    'marine_blue': { primary_color: '#0D3B66', secondary_color: '#0A2A4A', body_color: '#E6EBF0', sidebar_text_color: '#FFFFFF' },
    'blush_pink': { primary_color: '#FE828C', secondary_color: '#D94D63', body_color: '#FFEBED', sidebar_text_color: '#FFFFFF' },
    'mossy_mist': { primary_color: '#8FBC8F', secondary_color: '#5F8B5F', body_color: '#F0F8F0', sidebar_text_color: '#333333' },
    'arctic_frost': { primary_color: '#B0E0E6', secondary_color: '#87CEEB', body_color: '#E6F7FF', sidebar_text_color: '#333333' },
    'spiced_cider': { primary_color: '#D2691E', secondary_color: '#8B4513', body_color: '#FDF1E6', sidebar_text_color: '#FFFFFF' },
    'deep_violet': { primary_color: '#4B0082', secondary_color: '#32004B', body_color: '#EDE6F5', sidebar_text_color: '#FFFFFF' },
    'ocean_green': { primary_color: '#20B2AA', secondary_color: '#008080', body_color: '#E6F4F3', sidebar_text_color: '#FFFFFF' },
    'sunny_days': { primary_color: '#FFF44F', secondary_color: '#D9D143', body_color: '#FFFDE7', sidebar_text_color: '#333333' },
    'royal_magenta': { primary_color: '#C71585', secondary_color: '#8B008B', body_color: '#F5E6F0', sidebar_text_color: '#FFFFFF' },
    'caramel_swirl': { primary_color: '#D2B48C', secondary_color: '#A67C52', body_color: '#FDF8F0', sidebar_text_color: '#333333' },
    'frosted_berry': { primary_color: '#D74177', secondary_color: '#9D2B5D', body_color: '#FCE8EF', sidebar_text_color: '#FFFFFF' }


};
function apply_theme(theme_key) {
    var p = color_themes[theme_key] || color_themes.default;

    document.getElementById('primary_color').value       = p.primary_color;
    document.getElementById('secondary_color').value     = p.secondary_color;
    document.getElementById('body_color').value          = p.body_color;
    document.getElementById('sidebar_text_color').value  = p.sidebar_text_color;

    document.documentElement.style.setProperty('--primary-color',   p.primary_color);
    document.documentElement.style.setProperty('--secondary-color', p.secondary_color);
    document.documentElement.style.setProperty('--body-color',      p.body_color);
    document.documentElement.style.setProperty('--sidebar-text',    p.sidebar_text_color);
}

var preset_select = document.getElementById('predefined_theme');
preset_select.addEventListener('change', function () {
    if (this.value) apply_theme(this.value);
});

var id_to_css = {
  primary_color: '--primary-color',
  secondary_color: '--secondary-color',
  body_color: '--body-color',
  sidebar_text_color: '--sidebar-text'
};

document.addEventListener('change', function (e) {
  var t = e.target;
  if (t && t.id === 'predefined_theme' && t.value) apply_theme(t.value);
});

document.addEventListener('input', function (e) {
  var t = e.target;
  var css_var = t && id_to_css[t.id];
  if (!css_var) return;
  document.documentElement.style.setProperty(css_var, t.value);
  var preset_select = document.getElementById('predefined_theme');
  if (preset_select) preset_select.value = '';
});

document.addEventListener('click', function (e) {
  var btn = e.target.closest('#reset-colors');
  if (!btn) return;

  var preset_select = document.getElementById('predefined_theme');
  if (preset_select) preset_select.value = 'default';
  apply_theme('default');
});

</script>
<script>
(function () {
  const VARS = {
    primary_color: '--primary-color',
    secondary_color: '--secondary-color',
    body_color: '--body-color',
    sidebar_text_color: '--sidebar-text'
  };

  function toHexByte(n) {
    const h = Number(n).toString(16);
    return h.length === 1 ? '0' + h : h;
  }

  function canon(color) {
    if (!color) return '';
    let s = String(color).trim().toLowerCase().replace(/\s+/g, '');
    if (!s) return '';

    if (s.startsWith('#') && s.length === 4) {
      return '#' + s[1] + s[1] + s[2] + s[2] + s[3] + s[3];
    }

    if (s.startsWith('#') && (s.length === 7 || s.length === 9)) {
      return s.slice(0, 7);
    }

    const m = s.match(/^rgba?\((\d+),(\d+),(\d+)(?:,[^)]+)?\)$/);
    if (m) {
      const r = toHexByte(m[1]), g = toHexByte(m[2]), b = toHexByte(m[3]);
      return '#' + r + g + b;
    }

    return s;
  }

function getRootColors() {
  const cs = getComputedStyle(document.documentElement);
  return {
    primary_color:       canon(cs.getPropertyValue(VARS.primary_color)),
    secondary_color:     canon(cs.getPropertyValue(VARS.secondary_color)),
    body_color:          canon(cs.getPropertyValue(VARS.body_color)),
    sidebar_text_color:  canon(cs.getPropertyValue(VARS.sidebar_text_color)) 
  };
}


  function findMatchingTheme(rootVals) {
    for (const [key, t] of Object.entries(color_themes)) {
      if (!t) continue;
      if (
        canon(t.primary_color)      === rootVals.primary_color &&
        canon(t.secondary_color)    === rootVals.secondary_color &&
        canon(t.body_color)         === rootVals.body_color &&
        canon(t.sidebar_text_color) === rootVals.sidebar_text_color
      ) {
        return key;
      }
    }
    return null;
  }

  function syncSelectWithRoot(trigger = 'manual') {
    const select = document.getElementById('predefined_theme');
    if (!select) return;

    const rootVals = getRootColors();
    const match = findMatchingTheme(rootVals);

   
    if (match) {
      select.value = match;
      apply_theme(match);
    } else {
      select.value = '';
    }
  }

  document.addEventListener('DOMContentLoaded', function () {
    syncSelectWithRoot('DOMContentLoaded');
  });

  document.addEventListener('input', function (e) {
    const t = e.target;
    const map = {
      primary_color: '--primary-color',
      secondary_color: '--secondary-color',
      body_color: '--body-color',
      sidebar_text_color: '--sidebar-text'
    };
    const cssVar = t && map[t.id];
    if (!cssVar) return;

    document.documentElement.style.setProperty(cssVar, t.value);
    syncSelectWithRoot('input');
  });

  const mo = new MutationObserver(() => syncSelectWithRoot('mutation'));
  mo.observe(document.documentElement, { attributes: true, attributeFilter: ['style'] });

  window.__printRootTheme = function () {
    console.table(getRootColors());
  };
})();
</script>
