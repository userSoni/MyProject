using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace WpfLoginChat
{
    //Style of page animations for appearing/disappering
    public enum PageAnimation
    {
        None = 0,
        //The page slides in and fades in from the right
        SlideAndFadeInFromRight = 1,

        //The page slides out and fades out to the left
        SlideAndFadeOutToLeft = 2,
    }
}
