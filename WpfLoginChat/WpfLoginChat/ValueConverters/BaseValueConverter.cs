
using System;
using System.Globalization;
using System.Windows.Data;
using System.Windows.Markup;

namespace WpfLoginChat
{
    //A base value converter that allows direct xaml usage
    public abstract class BaseValueConverter<T> : MarkupExtension, IValueConverter
    where T : class, new ()
    {
        //A single static instance of this value converter
        private static T mConverter = null;

        public override object ProvideValue(IServiceProvider serviceProvider)
        {
            return mConverter ?? (mConverter = new T());
        }
        public abstract object Convert(object value, Type targetType, object parameter, CultureInfo culture);

        public abstract object ConvertBack(object value, Type targetType, object parameter, CultureInfo culture);
    }
}
