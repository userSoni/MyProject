using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Forms;
using System.Windows.Input;
using WpfLoginChat.DataModels;

namespace WpfLoginChat.ViewModel
{
    class WindowViewModel : BaseViewModel
    {

        private Window mWindow;
        private int mOuterMarginSize = 10;  //properties
        private int mWindowRadius = 10;

        private WindowDockPosition mDockPosition = WindowDockPosition.Undocked;

        public double WindowMinimumWidth { get; set; } = 700;
        public double WindowMinimumHeight { get; set; } = 500;

        //the command to minimize the window
        public ICommand MinimizeCommand { get; set; }

        //to maximize the window
        public ICommand MaximizeCommand { get; set; }

        //to close the window
        public ICommand CloseCommand { get; set; }

        //to show the system menu of the window
        public ICommand MenuCommand { get; set; }

        public int ResizeBorder { get; set; } = 6;

        public Thickness ResizeBorderThickness
        {
            get { return new Thickness(ResizeBorder + OuterMarginSize); }
        }

        //changed to the older code
        public Thickness InnerContaintPadding { get; set; } = new Thickness(0);

        // the margin around the window to allow for a drop shadow
        public int OuterMarginSize
        {
            
            get { return mWindow.WindowState == WindowState.Maximized ? 0 : mOuterMarginSize; }  //this means it will return nothing
            set { mOuterMarginSize = value; }
        }

        //the margine around the window to allow for the drop shadow
        public Thickness OuterMargineSizeThickness { get { return new Thickness(OuterMarginSize); } }

        //the radius of the edges of the window
        public int WindowRadius
        {
            get { return mWindow.WindowState == WindowState.Maximized ? 0 : mWindowRadius; }  //this means it will return nothing
            set { mWindowRadius = value; }
        }

        public CornerRadius WindowCornerRadius { get { return new CornerRadius(WindowRadius); } }

        public int TitleHeight { get; set; } = 42;

        //the height of the title bar / caption of the windows
        public GridLength TitleHeightGridLength { get { return new GridLength(TitleHeight + ResizeBorder); } }

        //Login
        public ApplicationPage CurrentPage { get; set; } = ApplicationPage.Login;
        //public ApplicationPage CurrentPage { get; set; } = ApplicationPage.Chat;

        public WindowViewModel(Window window)
        {
            mWindow = window;

            //Listen out for the main window resizing
            mWindow.StateChanged += (sender, e) =>
            {
                //fire off events for all properties that are affected by a resize
                OnPropertyChanged(nameof(ResizeBorderThickness));
                OnPropertyChanged(nameof(OuterMarginSize));
                OnPropertyChanged(nameof(OuterMargineSizeThickness));
                OnPropertyChanged(nameof(WindowRadius));
                OnPropertyChanged(nameof(WindowCornerRadius));
            };

            //create command, codeBehind maximize, minimize, close menu shows after clicking on button
            MinimizeCommand = new RelayCommand(() => mWindow.WindowState = WindowState.Minimized);
            MaximizeCommand = new RelayCommand(() => mWindow.WindowState = WindowState.Maximized);
            CloseCommand = new RelayCommand(() => mWindow.Close());
            MenuCommand = new RelayCommand(() => SystemCommands.ShowSystemMenu(mWindow, GetMousePosition()));

            //Fix Windiw resizer issue
            var resizer = new WindowResizer(mWindow);

            resizer.WindowDockChanged += (dock) =>
            {
                // Store last position
                mDockPosition = dock;

                // Fire off resize events
            };
        }

        //c# wpf get screen position of mouse (google search)
        //Helpers
        //Get the current ouse position on the screen
        private Point GetMousePosition()
        {
            //Position of the mouse relative to the window
            var position = Mouse.GetPosition(mWindow);

            //Add the window position so its a "ToScreen"
            return new Point(position.X + mWindow.Left, position.Y + mWindow.Top);
        }
    }
}
