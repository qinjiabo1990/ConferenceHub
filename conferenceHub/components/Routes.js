import React from 'react';
import { createStackNavigator, } from 'react-navigation';

import {HomelistStack} from './Homelist';
import Login from './Login';
import Signup from './Signup';

export const RootStack = createStackNavigator({
    Login: {
        screen: Login,
    },
    Signup: {
        screen: Signup,
    },
    HomelistStack: {
        screen: HomelistStack,
    },
    },{
        headerMode: 'none',
    }
);