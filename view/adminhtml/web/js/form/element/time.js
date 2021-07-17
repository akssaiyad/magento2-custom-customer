/**
 * @category  Aks Customers
 * @package   Aks_Customers
 * @copyright Copyright (c) 2021
 * @author    Saiyad Asif <akssaiyad@gmail.com>
 */
 
define([
    'Magento_Ui/js/form/element/date'
], function(Date) {
    'use strict';

    return Date.extend({
        defaults: {
            options: {
                showsDate: true,
                showsTime: false,
                timeOnly: false
            },

            elementTmpl: 'ui/form/element/date'
        }
    });
});