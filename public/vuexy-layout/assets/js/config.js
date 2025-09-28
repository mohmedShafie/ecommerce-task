/**
 * Template Customizer for Vuexy
 */

'use strict';

let config = {
  colors: {
    primary: '#7367f0',
    secondary: '#82868b',
    success: '#28c76f',
    info: '#00cfe8',
    warning: '#ff9f43',
    danger: '#ea5455',
    dark: '#4b4b4b',
    black: '#000',
    white: '#fff',
    cardColor: '#fff',
    bodyBg: '#f5f5f9',
    bodyColor: '#697a8d',
    headingColor: '#566a7f',
    textMuted: '#a1acb8',
    borderColor: '#eceef1'
  },
  colors_dark: {
    primary: '#7367f0',
    secondary: '#82868b',
    success: '#28c76f',
    info: '#00cfe8',
    warning: '#ff9f43',
    danger: '#ea5455',
    dark: '#4b4b4b',
    black: '#000',
    white: '#fff',
    cardColor: '#2b2c40',
    bodyBg: '#161d31',
    bodyColor: '#b4b7bd',
    headingColor: '#cbcbe2',
    textMuted: '#676d7d',
    borderColor: '#444564'
  },
  fonts: {
    fontFamily: 'Public Sans, Helvetica, Arial, sans-serif'
  }
};

// Check if dark mode is active
let isDarkStyle = document.documentElement.getAttribute('data-bs-theme') === 'dark' ||
                  document.documentElement.classList.contains('dark-style');

let assetsPath = document.documentElement.getAttribute('data-assets-path'),
  templateName = document.documentElement.getAttribute('data-template'),
  rtlSupport = true;

// Completely disable template customizer to prevent CSS loading errors
if (typeof TemplateCustomizer !== 'undefined') {
  // Override the TemplateCustomizer constructor to do nothing
  window.TemplateCustomizer = function() {
    return {
      setRtl: function() {},
      setStyle: function() {},
      setTheme: function() {},
      setLayoutType: function() {},
      setLayoutMenuFlipped: function() {},
      setDropdownOnHover: function() {},
      setLayoutNavbarFixed: function() {},
      setLayoutFooterFixed: function() {},
      setLang: function() {},
      update: function() {},
      clearLocalStorage: function() {},
      destroy: function() {}
    };
  };

  // Also override the global TemplateCustomizer variable
  window.TemplateCustomizer = window.TemplateCustomizer;

  // Don't create an instance
  // window.templateCustomizer = new TemplateCustomizer({...});
}

// Disable i18n to prevent JSON loading errors
window.i18next = {
  t: function(key) {
    return key;
  },
  language: 'en'
};

// Disable search functionality to prevent JSON loading errors
window.searchData = {
  pages: [],
  files: []
};
