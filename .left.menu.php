<?
/**
 * @author Vladimir P. Erdman [v.p.erdman@gmail.com]
 */
if (LANGUAGE_ID == 'ru') {
    $lang = '';
} else {
    $lang = LANGUAGE_ID . '/';
}

$menuLinks = Array(
    Array(
        GetMessage('Overview'),
        $SUBDIR . $lang . "overview/"
    ),
    Array(
        GetMessage('MENU_TARGETS'),
        $SUBDIR . $lang . "targets/"
    ),
    Array(
        GetMessage('Roadmap'),
        $SUBDIR . $lang . "roadmap/"
    ),
    Array(
        GetMessage('ProductBacklog'),
        "#"
    ),
    Array(
        GetMessage('SprintBacklog'),
        "#"
    ),
    Array(
        GetMessage('Members'),
        "#"
    ),
    Array(
        GetMessage('StoryPoints'),
        "#"
    ),
    Array(
        GetMessage('SprintReviews'),
        "#"
    ),
    Array(
        GetMessage('Budget'),
        "#"
    )
);
?>
