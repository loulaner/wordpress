/**
 *  * 开发者专用：WordPress调试模式。
 *   *
 *    * 将这个值改为true，WordPress将显示所有用于开发的提示。
 *     * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *      */
define('WP_DEBUG', false);

/**
 *  * zh_CN本地化设置：启用ICP备案号显示
 *   *
 *    * 可在设置→常规中修改。
 *     * 如需禁用，请移除或注释掉本行。
 *      */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
  define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
