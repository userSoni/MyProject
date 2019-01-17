using System;
using System.Windows;
using System.Windows.Media;

namespace WpfLoginChat
{
    //base attached property to replace the vanilla WPF attached property

    public abstract class BaseAttachedProperty<Parent, Property> where Parent : BaseAttachedProperty<Parent, Property>, new()
    {
        public event Action<DependencyObject, DependencyPropertyChangedEventArgs> ValueChanged = (sender, e) => { };
        public static Parent Instence { get; private set; } = new Parent();


        //The attached property for this class
        public static readonly DependencyProperty ValueProperty = 
            DependencyProperty.RegisterAttached("Value", typeof(Property), typeof(BaseAttachedProperty<Parent, Property>),new PropertyMetadata(new PropertyChangedCallback(OnValuePropertyChanged)));


        //The callback event when the 'ValueProperty' is changed
        //the UI element that had it's properyt changed. The arguments for the event.
        private static void OnValuePropertyChanged(DependencyObject d, DependencyPropertyChangedEventArgs e)
        {
            //call the parent function
            Instence.OnValueChnaged(d, e);

            //Call event listeners
            Instence.ValueChanged(d, e);
        }

        //Gets the attached property
        public static Property GetValue(DependencyObject d) => (Property) d.GetValue(ValueProperty);
        public static void SetValue(DependencyObject d, Property value) => d.SetValue(ValueProperty, value);

        //The method that uis called when any attached property of this type is changed
        public virtual void OnValueChnaged(DependencyObject sender, DependencyPropertyChangedEventArgs e)
        {

        }
    }
}
