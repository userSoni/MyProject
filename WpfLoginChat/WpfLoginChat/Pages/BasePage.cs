using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Media.Animation;

namespace WpfLoginChat
{
    public class BasePage<VM> : Page   //inherited by self pages 
        where VM : BaseViewModel, new()
    {
        //the ViewModel asociated with this page
        private VM mViewModel;

        //The animation the play when the page is first loaded
        public PageAnimation PageLoadAnimation { get; set; } = PageAnimation.SlideAndFadeInFromRight;

        //The animation the play when the page is unloaded
        public PageAnimation PageUnLoadAnimation { get; set; } = PageAnimation.SlideAndFadeOutToLeft;

        //The time any slide animation takes to complete
        public float SlideSeconds { get; set; } = 0.8f;

        //the ViewModel asociated with this page
        public VM ViewModel
        {
            get { return mViewModel; }
            set
            {
                if (mViewModel == value)
                    return;

                mViewModel = value;

                this.DataContext = mViewModel;
            }
        }

        public BasePage()
        {
            //if we are animating in, hide to begin with
            if (this.PageLoadAnimation != PageAnimation.None)
                this.Visibility = Visibility.Collapsed;

            //Listen out for the page loading
            this.Loaded += BasePage_Loaded;

            //Create a default view model
            this.ViewModel = new VM();
        }

        //Once the page is loaded, perform any required animation
        private async void BasePage_Loaded(object sender, System.Windows.RoutedEventArgs e)
        {
            await AnimateIn();
        }

        public async Task AnimateIn()
        {
            if (this.PageLoadAnimation == PageAnimation.None)
                return;

            switch (this.PageLoadAnimation)
            {
                case PageAnimation.SlideAndFadeInFromRight:

                    await this.SlideAndFadeInFromRight(this.SlideSeconds);
                    //await this.SlideAndFadeInFromRight(this.SlideSeconds * 5); // for slow animation multiply by number of seconds

                    break;
            }
        }

        public async Task AnimateOut()
        {
            if (this.PageUnLoadAnimation == PageAnimation.None)
                return;

            switch (this.PageUnLoadAnimation)
            {
                case PageAnimation.SlideAndFadeOutToLeft:

                    await this.SlideAndFadeOutToLeft(this.SlideSeconds);
                    //await this.SlideAndFadeInFromRight(this.SlideSeconds * 5);

                    break;
            }
        }
    }
}
