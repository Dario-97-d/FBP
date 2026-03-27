<?php

  function CSS_render_stylesheets()
  {
    global $_CURRENT_PAGE_NAME;
    global $_FILEREF_css_references;

    require $_FILEREF_css_references;

    $css_refs = match( $_CURRENT_PAGE_NAME )
    {
      // -- Mail --

      'mail-box'  => [ $_CSSREF_mail ],
      'mail_sent' => [ $_CSSREF_mail ],

      // -- Mates --

      'mates-overview' => [ $_CSSREF_mates_overview ],

      'mates-requests' => [ $_CSSREF_mates_requests ],
      'mates-sent'     => [ $_CSSREF_mates_requests ],

      // -- Play --

      'play-3-arrange' => [ $_CSSREF_play_3 ],
      'play-3-game'    => [ $_CSSREF_play_3 ],

      'play-5-arrange' => [ $_CSSREF_play_5 ],
      'play-5-game'    => [ $_CSSREF_play_5 ],

      // -- Player --

      'player-development',
      'player-overview'
        =>
        [
          $_CSSREF_generic_attributes,
          $_CSSREF_playing_attributes
        ],

      'player-profile' => [ $_CSSREF_generic_attributes ],

      // -- Ranking --

      'ranking-player' => [ $_CSSREF_ranking ],
      'ranking-team'   => [ $_CSSREF_ranking ],

      // -- Search --

      'search-player' => [ $_CSSREF_search ],
      'search-team'   => [ $_CSSREF_search ],

      // -- Team --

      'team-center'   => [ $_CSSREF_team_center ],
      'team-overview' => [ $_CSSREF_team_own_members ],
      'team-profile'  => [ $_CSSREF_team_profile ],

      // -- Team Manage --

      'team-manage-applications' => [ $_CSSREF_team_manage_applications ],
      'team-manage-invites'      => [ $_CSSREF_team_manage_invites ],
      'team-manage-members'      => [ $_CSSREF_team_own_members ],

      default => []
    };

    $all_links = '';

    foreach ( $css_refs as $css_ref )
    {
      $all_links .= '<link rel="stylesheet" href="'.htmlspecialchars( $css_ref, ENT_QUOTES, 'UTF-8' ).'">' . PHP_EOL;
    }

    return $all_links;
  }
