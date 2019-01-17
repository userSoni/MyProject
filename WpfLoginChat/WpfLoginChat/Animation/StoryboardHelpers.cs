using System;
using System.Collections.Generic;
using System.Dynamic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Media.Animation;

namespace WpfLoginChat
{
    public static class StoryboardHelpers
    {
        public static void AddSlideFromRight(this Storyboard storyboard, float seconds, double offset,
            float decelerationRatio = 0.9f)
        {
            //create the margin animation from right
            var animation = new ThicknessAnimation
            {
                Duration = new Duration(TimeSpan.FromSeconds(seconds)),
                From = new Thickness(offset, 0, -offset, 0),            //remember to give minus'-', otherwise the slide starts from the center
                To = new Thickness(0),
                DecelerationRatio = decelerationRatio
            };
            //set the target property name
            Storyboard.SetTargetProperty(animation, new PropertyPath("Margin"));

            //Add this to the storyboard
            storyboard.Children.Add(animation);
        }

        public static void AddSlideToLeft(this Storyboard storyboard, float seconds, double offset,
            float decelerationRatio = 0.9f)
        {
            //create the margin animation from right
            var animation = new ThicknessAnimation
            {
                Duration = new Duration(TimeSpan.FromSeconds(seconds)),
                From = new Thickness(0),            //remember to give minus'-', otherwise the slide starts from the center
                To = new Thickness(-offset, 0, offset, 0),
                DecelerationRatio = decelerationRatio
            };
            //set the target property name
            Storyboard.SetTargetProperty(animation, new PropertyPath("Margin"));

            //Add this to the storyboard
            storyboard.Children.Add(animation);
        }

        public static void AddFadeIn(this Storyboard storyboard, float seconds)
        {
            //create the margin animation from right
            var animation = new DoubleAnimation
            {
                Duration = new Duration(TimeSpan.FromSeconds(seconds)),
                From = 0,
                To = 1,
            };
            //set the target property name
            Storyboard.SetTargetProperty(animation, new PropertyPath("Opacity"));

            //Add this to the storyboard
            storyboard.Children.Add(animation);
        }

        public static void AddFadeOut(this Storyboard storyboard, float seconds)
        {
            //create the margin animation from right
            var animation = new DoubleAnimation
            {
                Duration = new Duration(TimeSpan.FromSeconds(seconds)),
                From = 1,
                To = 0,
            };
            //set the target property name
            Storyboard.SetTargetProperty(animation, new PropertyPath("Opacity"));

            //Add this to the storyboard
            storyboard.Children.Add(animation);
        }
    }
}
