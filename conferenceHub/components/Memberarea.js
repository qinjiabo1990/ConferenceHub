import React from 'react';
import {
    StyleSheet,
    Text,
    View,
    AsyncStorage,
    ListView,
    ActivityIndicator,
    TouchableOpacity,
    Image, Button,
} from 'react-native';


export default class Memberarea extends React.Component {

    static navigationOptions= ({navigation}) =>({
        title: 'Account',
        headerLeft:
            <Button style={{flex:1}}
                    title='Log out'
                    onPress={() => navigation.goBack(null)}
            />,
    });

    state = {
        userEmail: '',
        isLoading: true,
    }

    componentDidMount() {
        AsyncStorage.getItem('email').then((email)=>{
            this.setState({userEmail: email});
            return fetch('http://conference-app.000webhostapp.com/account.php',{
                method:'post',
                header:{
                    'Accept': 'application/json',
                    'Content-type': 'application/json'
                },
                body:JSON.stringify({
                    email: this.state.userEmail
                })
            })
                .then((response) => response.json())
                .then((responseJson) => {
                    let ds = new ListView.DataSource({rowHasChanged: (r1, r2) => r1 !== r2});
                    this.setState({
                        isLoading: false,
                        dataSource: ds.cloneWithRows(responseJson),//copy other page and using dataSource to replace data.
                    }, function() {
                        // In this block you can do something with new state.
                    });
                })
                .catch((error) => {
                    console.error(error);
                });
        })
    }

    render() {
        if (this.state.isLoading) {
            return (
                <View style={{flex:1, justifyContent:'center', alignItems:'center'}}>
                    <ActivityIndicator size='large' color='#330066' animating/>
                </View>
            );
        }
        return (
            <View style={styles.MainContainer}>
                <ListView
                    dataSource={this.state.dataSource}
                    renderSeparator= {this.ListViewItemSeparator}
                    renderRow={(item) =>
                        <View style={{flex:1, flexDirection: 'column'}} >
                            <TouchableOpacity style={{flex:1, flexDirection:'row', marginBottom: 3}}
                                              onPress={()=>alert(item.id)}>
                                <Image style={{width:100, height:100, margin:5,}}
                                       source={{uri: item.image}} />
                                <View style={{flex:1, justifyContent: 'center', }}>
                                    <Text style={{fontSize: 18, marginBottom: 5, }}>
                                        Username: {item.username}
                                    </Text>
                                    <Text style={{fontSize: 15, marginBottom: 20, }}>
                                        Your Password: {item.password}
                                    </Text>
                                    <Text style={{fontSize: 13, }}>
                                        Your email: {item.email}
                                    </Text>
                                </View>
                            </TouchableOpacity>
                        </View>
                    }
                />
            </View>
        );
    }
}

const styles = StyleSheet.create({
    MainContainer :{
        flex:1,
    },
});
