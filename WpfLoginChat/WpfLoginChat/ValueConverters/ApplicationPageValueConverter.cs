﻿using System;
using System.Diagnostics;
using System.Globalization;
using WpfLoginChat.DataModels;

namespace WpfLoginChat.ValueConverters
{
    public class ApplicationPageValueConverter : BaseValueConverter<ApplicationPageValueConverter>
    {
        public override object Convert(object value, Type targetType, object parameter, CultureInfo culture)
        {
            //Find the appropriate page
            switch ((ApplicationPage)value)
            {
                case ApplicationPage.Login:
                    return new LoginPage();

                case ApplicationPage.Register:
                    return new RegisterPage();

                case ApplicationPage.Chat:
                    return new ChatPage();

                default:
                        Debugger.Break();
                        return null;
            }
        }

        public override object ConvertBack(object value, Type targetType, object parameter, CultureInfo culture)
        {
            throw new NotImplementedException();
        }
    }
}
